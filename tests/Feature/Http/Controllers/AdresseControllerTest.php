<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Adresse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AdresseController
 */
class AdresseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $adresses = Adresse::factory()->count(3)->create();

        $response = $this->get(route('adresse.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AdresseController::class,
            'store',
            \App\Http\Requests\AdresseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $pays = $this->faker->word;
        $province = $this->faker->word;
        $commune = $this->faker->word;

        $response = $this->post(route('adresse.store'), [
            'pays' => $pays,
            'province' => $province,
            'commune' => $commune,
        ]);

        $adresses = Adresse::query()
            ->where('pays', $pays)
            ->where('province', $province)
            ->where('commune', $commune)
            ->get();
        $this->assertCount(1, $adresses);
        $adresse = $adresses->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $adresse = Adresse::factory()->create();

        $response = $this->get(route('adresse.show', $adresse));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AdresseController::class,
            'update',
            \App\Http\Requests\AdresseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $adresse = Adresse::factory()->create();
        $pays = $this->faker->word;
        $province = $this->faker->word;
        $commune = $this->faker->word;

        $response = $this->put(route('adresse.update', $adresse), [
            'pays' => $pays,
            'province' => $province,
            'commune' => $commune,
        ]);

        $adresse->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($pays, $adresse->pays);
        $this->assertEquals($province, $adresse->province);
        $this->assertEquals($commune, $adresse->commune);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $adresse = Adresse::factory()->create();

        $response = $this->delete(route('adresse.destroy', $adresse));

        $response->assertNoContent();

        $this->assertModelMissing($adresse);
    }
}
