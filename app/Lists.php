<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mailchimp_list_id',
        'subscribe_url_short',
        'name',
        'permission_reminder',
        'email_type_option',
        'company',
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'country',
        'phone',
        'from_name', 
        'from_email',
        'subject',
        'language'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function saveData($request, $mailchimp_list_id, $subscribe_url_short)
    {
        $list = new Lists;

        $list->mailchimp_list_id    = $mailchimp_list_id;
        $list->subscribe_url_short  = $subscribe_url_short;
        $list->name                 = $request->name;
        $list->permission_reminder  = $request->permission_reminder;
        $list->email_type_option    = false;
        $list->company              = $request->company;
        $list->address1             = $request->address1;
        $list->address2             = $request->address2;
        $list->city                 = $request->city;
        $list->state                = $request->state;
        $list->zip                  = $request->zip;
        $list->country              = $request->country;
        $list->phone                = $request->phone;
        $list->from_name            = $request->from_name;
        $list->from_email           = $request->from_email;
        $list->subject              = $request->subject;
        $list->language             = 'US';

        $list->save();

        return $list->id;
    }

    public function getMailChimpListId($id)
    {
        $list = Lists::find($id);
        $mailChimpListId = $list->mailchimp_list_id;

        return $mailChimpListId;
    }

    public function updateData($id, $request)
    {
        $list = Lists::find($id);

        $list->name                 = $request->name;
        $list->permission_reminder  = $request->permission_reminder;
        $list->company              = $request->company;
        $list->address1             = $request->address1;
        $list->address2             = $request->address2;
        $list->city                 = $request->city;
        $list->state                = $request->state;
        $list->zip                  = $request->zip;
        $list->country              = $request->country;
        $list->phone                = $request->phone;
        $list->from_name            = $request->from_name;
        $list->from_email           = $request->from_email;
        $list->subject              = $request->subject;

        $list->save();

        return $list->id;
    }

    public function deleteData($id)
    {
        $list = Lists::find($id)->delete();
    }

}
