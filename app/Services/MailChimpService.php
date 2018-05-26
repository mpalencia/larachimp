<?php 
namespace App\Services;

//https://github.com/pacely/mailchimp-api-v3
use MC;

class MailChimpService
{
    /**
     * @param array $request
     */
    public function addList($request)
    {
        $mcListAdd = MC::post('lists', [
            'name' => $request->name,
            'permission_reminder' => $request->permission_reminder,
            'email_type_option' => false,
            'contact' => [
                'company' => $request->company,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
                'phone' => $request->phone
            ],
            'campaign_defaults' => [
                'from_name' => $request->from_name,
                'from_email' => $request->from_email,
                'subject' => $request->subject,
                'language' => 'US'
            ]
        ]);

        return $mcListAdd;
    }

    /**
     * @param array $request
     * @param int $mailChimpListId
     */
    public function editList($request, $mailChimpListId)
    {
        $mcListUpdate = MC::patch('lists/'.$mailChimpListId.'', [
            'name' => $request->name,
            'permission_reminder' => $request->permission_reminder,
            'email_type_option' => false,
            'contact' => [
                'company' => $request->company,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
                'phone' => $request->phone
            ],
            'campaign_defaults' => [
                'from_name' => $request->from_name,
                'from_email' => $request->from_email,
                'subject' => $request->subject,
                'language' => 'US'
            ]
        ]);

        return $mcListUpdate;
    }

    /**
     * @param int $mailChimpListId
     */
    public function deleteList($mailChimpListId)
    {
        $mailChimpDelete = MC::delete('lists/'.$mailChimpListId.'');

        return $mailChimpDelete;
    }

    /**
     * @param array $request
     * @param int $mailchimpListId
     */
    public function addMember($request, $mailchimpListId)
    {
        $mcMembersAdd = MC::post('lists/'.$mailchimpListId.'/members', [
            'email_address' => $request->email_address,
            'status' => 'subscribed'
        ]);

        return $mcMembersAdd;
    }

    /**
     * @param array $request
     * @param int $mailchimpListId
     * @param int $subscriberHash
     */
    public function editMember($request, $mailchimpListId, $subscriberHash)
    {
        $mcMemberUpdate = MC::patch('/lists/'.$mailchimpListId.'/members/'.$subscriberHash.'', [
            'email_address' => $request->email_address
        ]);

        return $mcMemberUpdate;
    }

    /**
     * @param int $mailchimpListId
     * @param int $subscriberHash
     */
    public function deleteMember($mailchimpListId, $subscriberHash)
    {
        $mcMemberDelete = MC::delete('lists/'.$mailchimpListId.'/members/'.$subscriberHash.'');

        return $mcMemberDelete;
    }

}
