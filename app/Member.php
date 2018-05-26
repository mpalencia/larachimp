<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'list_id',
        'email',
        'first_name',
        'last_name',
        'subscriber_hash',
        'status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function saveData($request, $subscriber_hash)
    {
        //save on members table
        $member = new Member;

        $member->list_id          = $request->list_id;
        $member->email            = $request->email_address;
        $member->first_name       = $request->first_name;
        $member->last_name        = $request->last_name;
        $member->subscriber_hash  = $subscriber_hash;
        $member->status           = 'subscribed';

        $member->save();

        return $member->id;
    }

    public function getSubscriberHash($id)
    {
        $member = Member::find($id);
        $subscriberHash = $member->subscriber_hash;
        return $subscriberHash;
    }

    public function updateData($id, $request, $subscriber_hash)
    {
        $member = Member::find($id);
        
        $member->email            = $request->email_address;
        $member->first_name       = $request->first_name;
        $member->last_name        = $request->last_name;
        $member->subscriber_hash  = $subscriber_hash;

        $member->save();

        return $member->id;
    }

    public function deleteData($id)
    {
        $member = Member::find($id)->delete();
    }

}
