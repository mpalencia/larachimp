<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Services\MailChimpService;

//models
use App\Lists;
use App\Member;

class ListMemberController extends Controller
{

    /** @var  \App\Services\MailChimpService */
    protected $mailChimpService;

    /*
     * @var \App\Lists
     */
    protected $lists;

    /*
     * @var \App\Member
     */
    protected $member;


    public function __construct( MailChimpService $mailChimpService, Lists $lists, Member $member)
    {
        $this->mailChimpService = $mailChimpService;
        $this->lists = $lists;
        $this->member = $member;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $listId = key($request->all());
        return view('list-members.create', compact('listId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email_address' => 'required|email'
        ]);

        $mailChimpListId = $this->lists->getMailChimpListId($request->list_id);
        //save member on Mailchimp
        $mcMembersAdd = $this->mailChimpService->addMember($request, $mailChimpListId);

        if($mcMembersAdd){
            //save member on Database
            $memberAdd = $this->member->saveData($request, $mcMembersAdd['id']);
            //success on save
            $message = 'Member successfully added!';
            return redirect()->action('ListMemberController@show', $request->list_id)->with('status', $message);
        } else {
            //error on save
            $message = 'Member failed to save!';
            return redirect()->back()->with('status', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($list_id)
    {
        $members = Member::where('list_id', $list_id)->paginate(10);
        $list = Lists::find($list_id);

        return view('list-members.show', compact('members', 'list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = Member::find($id);
        if (empty($member)) {
            abort(404);
        }

        return view('list-members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'email_address' => 'required|email'
        ]);

        $subscriberHash = $this->member->getSubscriberHash($id);
        $member = Member::find($id);
        $mailChimpListId = $this->lists->getMailChimpListId($member->list_id);

        //update member on Mailchimp
        $mcMemberUpdate = $this->mailChimpService->editMember($request, $mailChimpListId, $subscriberHash);

        if($mcMemberUpdate){
            //update on members table
            $memberUpdate = $this->member->updateData($id, $request, $mcMemberUpdate['id']);
            //success on save
            $message = 'Member successfully updated!';
            return redirect()->action('ListMemberController@show', $member->list_id)->with('status', $message);
        } else {
            //error on save
            $message = 'Member failed to update!';
            return redirect()->back()->with('status', $message);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $subscriberHash = $this->member->getSubscriberHash($id);
        $member = Member::find($id);
        $mailChimpListId = $this->lists->getMailChimpListId($member->list_id);

        //delete member on Mailchimp
        $mcMemberDelete = $this->mailChimpService->deleteMember($mailChimpListId, $subscriberHash);

        if($mcMemberDelete){
            //delete on members table
            $memberDelete = $this->member->deleteData($id);
            //success on delete
            $message = 'Member successfully deleted!';
            return redirect()->action('ListMemberController@show', $member->list_id)->with('status', $message);

        } else {
            //error on delete
            $message = 'Member failed to update!';
            return redirect()->back()->with('status', $message);
        }
    }
}
