<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\TauxImposamble;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TauxImposambleController
 */
class TauxImposambleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $tauxImposambles = TauxImposamble::factory()->count(3)->create();

        $response = $this->get(route('taux-imposamble.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TauxImposambleController::class,
            'store',
            \App\Http\Requests\TauxImposambleStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $date = $this->faker->date();
        $min_montant = $this->faker->randomFloat(/** double_attributes **/);
        $max_montant = $this->faker->randomFloat(/** double_attributes **/);
        $taux_imposamble = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('taux-imposamble.store'), [
            'date' => $date,
            'min_montant' => $min_montant,
            'max_montant' => $max_montant,
            'taux_imposamble' => $taux_imposamble,
        ]);

        $tauxImposambles = TauxImposamble::query()
            ->where('date', $date)
            ->where('min_montant', $min_montant)
            ->where('max_montant', $max_montant)
            ->where('taux_imposamble', $taux_imposamble)
            ->get();
        $this->assertCount(1, $tauxImposambles);
        $tauxImposamble = $tauxImposambles->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $tauxImposamble = TauxImposamble::factory()->create();

        $response = $this->get(route('taux-imposamble.show', $tauxImposamble));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TauxImposambleController::class,
            'update',
            \App\Http\Requests\TauxImposambleUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $tauxImposamble = TauxImposamble::factory()->create();
        $date = $this->faker->date();
        $min_montant = $this->faker->randomFloat(/** double_attributes **/);
        $max_montant = $this->faker->randomFloat(/** double_attributes **/);
        $taux_imposamble = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('taux-imposamble.update', $tauxImposamble), [
            'date' => $date,
            'min_montant' => $min_montant,
            'max_montant' => $max_montant,
            'taux_imposamble' => $taux_imposamble,
        ]);

        $tauxImposamble->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals(Carbon::parse($date), $tauxImposamble->date);
        $this->assertEquals($min_montant, $tauxImposamble->min_montant);
        $this->assertEquals($max_montant, $tauxImposamble->max_montant);
        $this->assertEquals($taux_imposamble, $tauxImposamble->taux_imposamble);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $tauxImposamble = TauxImposamble::factory()->create();

        $response = $this->delete(route('taux-imposamble.destroy', $tauxImposamble));

        $response->assertNoContent();

        $this->assertModelMissing($tauxImposamble);
    }
}
