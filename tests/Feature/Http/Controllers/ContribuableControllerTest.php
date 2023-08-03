<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Adresse;
use App\Models\Contribuable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ContribuableController
 */
class ContribuableControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $contribuables = Contribuable::factory()->count(3)->create();

        $response = $this->get(route('contribuable.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ContribuableController::class,
            'store',
            \App\Http\Requests\ContribuableStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $title = $this->faker->sentence(4);
        $adresse = Adresse::factory()->create();
        $nif = $this->faker->word;

        $response = $this->post(route('contribuable.store'), [
            'title' => $title,
            'adresse_id' => $adresse->id,
            'nif' => $nif,
        ]);

        $contribuables = Contribuable::query()
            ->where('title', $title)
            ->where('adresse_id', $adresse->id)
            ->where('nif', $nif)
            ->get();
        $this->assertCount(1, $contribuables);
        $contribuable = $contribuables->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $contribuable = Contribuable::factory()->create();

        $response = $this->get(route('contribuable.show', $contribuable));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ContribuableController::class,
            'update',
            \App\Http\Requests\ContribuableUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $contribuable = Contribuable::factory()->create();
        $title = $this->faker->sentence(4);
        $adresse = Adresse::factory()->create();
        $nif = $this->faker->word;

        $response = $this->put(route('contribuable.update', $contribuable), [
            'title' => $title,
            'adresse_id' => $adresse->id,
            'nif' => $nif,
        ]);

        $contribuable->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($title, $contribuable->title);
        $this->assertEquals($adresse->id, $contribuable->adresse_id);
        $this->assertEquals($nif, $contribuable->nif);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $contribuable = Contribuable::factory()->create();

        $response = $this->delete(route('contribuable.destroy', $contribuable));

        $response->assertNoContent();

        $this->assertModelMissing($contribuable);
    }
}
