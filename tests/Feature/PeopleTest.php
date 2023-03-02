<?php

namespace Tests\Feature;

use App\Http\Controllers\PeopleController;
use App\Models\People;
use App\Models\Phones;
use Tests\TestCase;

class PeopleTest extends TestCase
{

    public function test_get_peoples_list_page()
    {
        $response = $this->get('/people');
        $response->assertStatus(200);
    }

    public function test_create_people()
    {
        $people = [
                'name' => "People test",
                'cpf' => "111.111.111-11",
                'email' => "email@email.com",
                'date_birth' => "01/01/2023",
                'nationality' => "Brasilian",
                'phones' => ["21999999", "219555555"]
            ];


        $create = $this->call('POST', '/people',  $people);
        $create->assertStatus(201);

        $peoples = People::get();
        $phones = Phones::get();
        $this->assertEquals(1, $peoples->count());
        $this->assertEquals(2, $phones->count());

    }

    public function test_delete_people_with_telephones()
    {
        $id = People::where("cpf", "111.111.111-11")->first()->id;
        $this->call('DELETE', "/people/$id");

        $people = People::where("cpf", "111.111.111-11")->get();
        $phones = Phones::where("people_id", $id)->get();
        $this->assertEquals(0, $people->count());
        $this->assertEquals(0, $phones->count());
    }
}
