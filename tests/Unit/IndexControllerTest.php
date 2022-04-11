<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\IndexController;

class IndexControllerTest extends TestCase
{
//    /**
//     * A basic unit test example.
//     *
//     * @return void
//     */
//    public function test_example()
//    {
//        $this->assertTrue(true);
//    }
    public function test_index(): void
    {
      $index = new IndexController();

      $index->index();

      $this->assertTrue(true);
    }


}
