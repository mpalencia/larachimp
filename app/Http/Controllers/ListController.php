<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

//services
use App\Services\MailChimpService;

//models
use App\Lists;

class ListController extends Controller
{
    /*
    * @var  \App\Services\MailChimpService 
    */
    protected $mailChimpService;

    /*
     * @var \App\Lists
     */
    protected $lists;

    public function __construct( MailChimpService $mailChimpService, Lists $lists)
    {
        $this->mailChimpService = $mailChimpService;
        $this->lists = $lists;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = Lists::paginate(10);
        return view('lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lists.create');
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
            'from_email' => 'required|email'
        ]);

        //save list on Mailchimp
        $mcListAdd = $this->mailChimpService->addList($request);

        if($mcListAdd){
            //save list on Database
            $listAdd = $this->lists->saveData($request, $mcListAdd['id'], $mcListAdd['subscribe_url_short']);
            //success on save
            $message = 'List successfully added!';
            return redirect()->action('ListController@index')->with('status', $message);
        } else {
            //error on save
            $message = 'List failed to save!';
            return redirect()->back()->with('status', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = Lists::find($id);
        if (empty($list)) {
            abort(404);
        }

        return view('lists.edit', compact('list'));
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
            'from_email' => 'required|email'
        ]);

        $mailChimpListId = $this->lists->getMailChimpListId($id);

        //update list on Mailchimp
        $mcListUpdate = $this->mailChimpService->editList($request, $mailChimpListId);

        if($mcListUpdate){
            //update list on Database
            $listUpdate = $this->lists->updateData($id, $request);
            //success on update
            $message = 'List successfully updated!';
            return redirect()->action('ListController@index')->with('status', $message);
        } else {
            //error on save
            $message = 'List failed to update!';
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
        $mailChimpListId = $this->lists->getMailChimpListId($id);

        //delete list on Mailchimp
        $mailChimpDelete = $this->mailChimpService->deleteList($mailChimpListId);

        if($mailChimpDelete) {
            //delete list on Database
            $listDelete = $this->lists->deleteData($id);
            //success on delete
            $message = 'List successfully deleted!';
            return redirect()->action('ListController@index')->with('status', $message);
        } else {
            //error on save
            $message = 'List failed to delete!';
            return redirect()->back()->with('status', $message);
        }
    }
}
