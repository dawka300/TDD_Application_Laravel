<?php

namespace Tests\Feature;

use App\Court;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourtsTest extends TestCase
{
    use RefreshDatabase;
    /**
    * @test
     */
    public function add_a_court_to_the_project(){

//        $this->withoutExceptionHandling();

        $response = $this->post('admin/sady', [
            'nazwa_sadu' => 'Nowy',
            'apelacja' => 'lubelska',
            'kod_sadu' => 'adw_01'
        ]);

        $response->assertOk();

        $this->assertCount(1, Court::all());

    }

    /**
     * @test
     */

    public function is_a_nazwa_sadu_required(){
//       $this->withoutExceptionHandling();

       $response = $this->post('admin/sady', [
          'nazwa_sadu' => '',
          'apelacja' => 'krakowska',
          'kod_sadu' => 'asw_54'
       ]);

       $response->assertSessionHasErrors('nazwa_sadu');

    }

    /**
     * @test
     */
    public function a_book_can_be_updated(){
//        $this->withoutExceptionHandling();

        $this->post('admin/sady', [
           'nazwa_sadu' => 'najwyzszy',
           'apelacja' => 'cała',
           'kod_sadu' => 'sn'
        ]);

        $court = Court::first();

        $response = $this->put('admin/sady/'.$court->id, [
            'nazwa_sadu' => 'Naczelny Sąd Administracyjny',
            'kod_sadu' => 'nsa'
        ]);
        $this->assertEquals('Naczelny Sąd Administracyjny', Court::first()->nazwa_sadu);
    }
}
