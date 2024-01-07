<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskApiTest extends TestCase
{
    //use RefreshDatabase;

    private static $isSeed = false;
    private static $data=[];

    public function setUp(): void{
        parent::setUp();
        if(!self::$isSeed){
            $this->artisan('migrate:fresh');
            $this->seed();
            self::$isSeed=true;
        }
    }

    /**
     * Test login users email or name
     */
    public function test_login_email_or_name(){
        $response = $this->post('/api/auth/login', ['email' => 'test', 'password'=>'1234']);
        $response->assertStatus(401);

        $response = $this->post('/api/auth/login', ['email' => 'test', 'password'=>'test']);
        $response->assertStatus(200);

        self::$data['u1'] = $this->getUser1()->original;
        self::$data['u2'] = $this->getUser2()->original;
    }

    /*
     * test users auth and get all task
     */
    public function test_users_getalltask(){
        $this->getUser1();
        $response = $this->getJson('/api/data/task');
        $response->assertStatus(200);

        $this->getUser2();
        $response = $this->getJson('/api/data/task');
        $response->assertStatus(200);
    }

    public function test_users_create_task(){
        $this->getUser1();
        $response = $this->postJson('/api/data/task',[
            'title'=>'textu1',
            'description'=>'text',
        ]);
        self::$data['u1']['task_id'] = $response->original->id;

        $this->getUser2();
        $response = $this->postJson('/api/data/task',[
            'title'=>'textu2',
            'description'=>'text',
        ]);
        self::$data['u2']['task_id'] = $response->original->id;
    }

    public function test_users_update_task(){
        $this->getUser1();
        $response = $this->putJson('/api/data/task',[
            'id'=>self::$data['u1']['task_id'],
            'title'=>'test',
        ]);
        $response
            ->assertStatus(200)
            ->assertJson(['title'=>'test']);

        $this->getUser2();
        $response = $this->putJson('/api/data/task',[
            'id'=>self::$data['u2']['task_id'],
            'title'=>'testU2',
        ]);
        $response
            ->assertStatus(200)
            ->assertJson(['title'=>'testU2']);
    }

    public function test_users_update_notid_task(){
        $u1_id = self::$data['u1']['task_id'];
        $u2_id = self::$data['u2']['task_id'];

        $this->getUser1();
        $response = $this->putJson('/api/data/task',[
            'id' => $u2_id,
            'title'=>'u1'
        ]);
        $response
            ->assertStatus(403);
        $this->getUser2();
        $response = $this->putJson('/api/data/task',[
            'id' => $u1_id,
            'title'=>'u2',
        ]);
        $response
            ->assertStatus(403);
    }

    public function test_get_page(){
        $response = $this->getJson('/api/data/task/page');
        $response->assertStatus(401);
        $this->getUser1();
        $response = $this->getJson('/api/data/task/page');
        $response->assertStatus(200);
    }

    public function test_get_task_from_id(){
        $u1_id = self::$data['u1']['task_id'];
        $u2_id = self::$data['u2']['task_id'];
        $response = $this->getJson('/api/data/task/id?id='.$u1_id);
        $response->assertStatus(401);
        $this->getUser1();
        $response = $this->getJson('/api/data/task/id?id='.$u1_id);
        $response->assertStatus(200);
        $response = $this->getJson('/api/data/task/id?id='.$u2_id);
        $response->assertStatus(403);
    }

    public function test_store_comment(){
        $u1_id = self::$data['u1']['task_id'];
        $u2_id = self::$data['u2']['task_id'];
        $this->getUser1();
        $response = $this->postJson('/api/data/comment',[
            'id'=>$u1_id,
            'comment'=>'comment'
        ]);
        $response->assertStatus(200);

        $response = $this->postJson('/api/data/comment',[
            'id'=>$u2_id,
            'comment'=>'comment'
        ]);
        $response->assertStatus(403);
    }

    public function test_get_comment_for_task(){
        $u1_id = self::$data['u1']['task_id'];
        $u2_id = self::$data['u2']['task_id'];
        $this->getUser1();
        $response = $this->getJson('/api/data/comment?id='.$u1_id);
        $response->assertStatus(200);
        $response->assertJsonFragment(["comment" => "comment"]);

        $response = $this->postJson('/api/data/comment?id='.$u2_id);
        $response->assertStatus(403);
    }

    public function test_users_delete_task(){
        $this->getUser1();
        $response = $this->deleteJson('/api/data/task',['id'=>self::$data['u2']['task_id']]);
        $response->assertStatus(403);
        $response = $this->deleteJson('/api/data/task',['id'=>self::$data['u1']['task_id']]);
        $response->assertStatus(200);
        $response = $this->deleteJson('/api/data/task',['id'=>self::$data['u1']['task_id']]);
        $response->assertStatus(403);
    }

    private function getUser1(){
        $response = $this->post('/api/auth/login', ['email' => 'test@test.ru', 'password'=>'test']);
        $response->assertStatus(200);
        return $response;
    }
    private function getUser2(){
        $response = $this->post('/api/auth/login', ['email' => 'test1@test.ru', 'password'=>'password']);
        $response->assertStatus(200);
        return $response;
    }
}
