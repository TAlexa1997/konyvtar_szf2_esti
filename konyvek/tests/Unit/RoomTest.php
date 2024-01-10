<?php

namespace Tests\Unit;

use App\Room;
use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $people = new Room(['Zsolt','Dóra']);
        $this->assertTrue($people->has('Dóra'));
    }
}
