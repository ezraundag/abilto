<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAcceptanceTest extends TestCase
{
    use DatabaseTransactions;
    
    /** @test */
    public function user_can_register()
    {
        $this->visit('/register')
             ->type('testuser', 'username')
             ->type('testuser@testcase.com', 'email')
             ->type('1234567', 'password')
             ->type('1234567', 'password_confirmation')
             ->press('Register')
             ->seePageIs('/user');
    }
    
    /** @test */    
    public function user_can_access_user_page() {
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
               ->withSession(['user_session_token' => $user->user_session_token])
               ->visit('/user')
               ->seePageIs('/user');
    }
    
    /** @test */  
    public function user_can_login() {
        factory(App\User::class)->create([
            'username' => 'testcase1',
            'email' =>  'testcase1@test.com',
            'password'  =>  bcrypt('password')
        ]);
        $this->visit('/login')
             ->type('testcase1', 'username')
             ->type('password', 'password')
             ->press('Login')
             ->seePageIs('/user');
    }
    
    /** @test */  
    public function user_can_update_user_page_fields() {
        $user = factory(App\User::class)->create([
            'username' => 'testcase1',
            'first_name'    =>  'testfirstname',
            'surname'    =>  'testusername',
            'email' =>  'testcase1@test.com',
            'password'  =>  bcrypt('password')
        ]);
        $this->actingAs($user)
               ->withSession(['user_session_token' => $user->user_session_token])
               ->visit('/user')
               ->type('testuser2', 'username')
               ->type('testuser2@testcase.com', 'email')
               ->type('updadatedtestfirstname', 'first_name')
               ->type('updadatedtestusername', 'surname')
               ->press('Update');
         $this->assertEquals('updadatedtestfirstname',$user->first_name);
         $this->assertEquals('updadatedtestusername', $user->surname);
         $this->assertEquals('testuser2', $user->username);
         $this->assertEquals('testuser2@testcase.com', $user->email);
                
    }
    
    /** @test */  
    public function log_out_user_on_mismatched_session_tokens() {
        $user = factory(App\User::class)->create();
        $this->actingAs($user)
               ->withSession(['user_session_token' => 'incorrect token'])
               ->visit('/user')
               ->seePageIs('/login');
    }
     
}
