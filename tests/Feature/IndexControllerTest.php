<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('custom.index');
    }

//    public function testAboutUs(): void
//    {
//        $response = $this->get('/aboutUs');
//
//        $response->assertStatus(200);
//    }
//
//    public function testDownloads(): void
//    {
//        $response = $this->get('/downloads');
//
//        $response->assertStatus(200);
//    }
//
//    public function testContacts(): void
//    {
//        $response = $this->get('/contacts');
//
//        $response->assertStatus(200);
//    }
}
