<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Lists;

class ListTest extends TestCase
{

    public function testSaveMailChimpListId()
    {
        $list = new Lists(['mailchimp_list_id'=>'Foo']);
        $this->assertEquals('Foo', $list->mailchimp_list_id);
    }

    public function testSaveUrl()
    {
        $list = new Lists(['subscribe_url_short'=>'Foo']);
        $this->assertEquals('Foo', $list->subscribe_url_short);
    }

    public function testSaveName()
    {
        $list = new Lists(['name'=>'Foo']);
        $this->assertEquals('Foo', $list->name);
    }

    public function testSavePermissionReminder()
    {
        $list = new Lists(['permission_reminder'=>'Foo']);
        $this->assertEquals('Foo', $list->permission_reminder);
    }

    public function testSaveEmailTypeOption()
    {
        $list = new Lists(['email_type_option'=>'Foo']);
        $this->assertEquals('Foo', $list->email_type_option);
    }

    public function testSaveCompany()
    {
        $list = new Lists(['company'=>'Foo']);
        $this->assertEquals('Foo', $list->company);
    }    

    public function testSaveAddress1()
    {
        $list = new Lists(['address1'=>'Foo']);
        $this->assertEquals('Foo', $list->address1);
    }

    public function testSaveAddress2()
    {
        $list = new Lists(['address2'=>'Foo']);
        $this->assertEquals('Foo', $list->address2);
    }

    public function testSaveCity()
    {
        $list = new Lists(['city'=>'Foo']);
        $this->assertEquals('Foo', $list->city);
    }

    public function testSaveState()
    {
        $list = new Lists(['state'=>'Foo']);
        $this->assertEquals('Foo', $list->state);
    }

    public function testSaveZip()
    {
        $list = new Lists(['zip'=>'Foo']);
        $this->assertEquals('Foo', $list->zip);
    }

    public function testSaveCountry()
    {
        $list = new Lists(['country'=>'Foo']);
        $this->assertEquals('Foo', $list->country);
    }

    public function testSavePhone()
    {
        $list = new Lists(['phone'=>'Foo']);
        $this->assertEquals('Foo', $list->phone);
    }

    public function testSaveFromName()
    {
        $list = new Lists(['from_name'=>'Foo']);
        $this->assertEquals('Foo', $list->from_name);
    }

    public function testSaveFromEmail()
    {
        $list = new Lists(['from_email'=>'Foo']);
        $this->assertEquals('Foo', $list->from_email);
    }

    public function testSaveFromSubject()
    {
        $list = new Lists(['subject'=>'Foo']);
        $this->assertEquals('Foo', $list->subject);
    }

    public function testSaveFromLanguage()
    {
        $list = new Lists(['language'=>'Foo']);
        $this->assertEquals('Foo', $list->language);
    }    

}
