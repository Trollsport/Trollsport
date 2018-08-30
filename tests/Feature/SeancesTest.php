<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Seance;
use Illuminate\Validation\ValidationException;

class SeancesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_gets_one_seance_by_its_id()
    {
        $seance = factory(Seance::class)->create();

        $tmp = $this->get(route('seance.show', ['id' => $seance->id]));
        $tmp->assertJson(['id' => $seance->id]);
    }

    /**
     * @test
     */
    function it_creates_a_seance_from_a_post_request()
    {
        $this->withoutExceptionHandling();
        $seance = factory(Seance::class)->make();
        $this->post(route('seance.store'), $seance->toArray())
            ->assertStatus(201);

        $this->assertDatabaseHas('seances', [
            'name' => $seance->name
        ]);
    }

    /**
     * @test
     */
    function a_name_is_required()
    {
        $this->withoutExceptionHandling();
        $this->expectException(ValidationException::class);
        $this->post(route('seance.store'), []);
    }
}
