<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Contribuable;
use App\Models\Employe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EmployeController
 */
class EmployeControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $employes = Employe::factory()->count(3)->create();

        $response = $this->get(route('employe.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmployeController::class,
            'store',
            \App\Http\Requests\EmployeStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $salaire_base = $this->faker->randomFloat(/** double_attributes **/);
        $frais_deplacement = $this->faker->randomFloat(/** double_attributes **/);
        $contribuable = Contribuable::factory()->create();

        $response = $this->post(route('employe.store'), [
            'salaire_base' => $salaire_base,
            'frais_deplacement' => $frais_deplacement,
            'contribuable_id' => $contribuable->id,
        ]);

        $employes = Employe::query()
            ->where('salaire_base', $salaire_base)
            ->where('frais_deplacement', $frais_deplacement)
            ->where('contribuable_id', $contribuable->id)
            ->get();
        $this->assertCount(1, $employes);
        $employe = $employes->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $employe = Employe::factory()->create();

        $response = $this->get(route('employe.show', $employe));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EmployeController::class,
            'update',
            \App\Http\Requests\EmployeUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $employe = Employe::factory()->create();
        $salaire_base = $this->faker->randomFloat(/** double_attributes **/);
        $frais_deplacement = $this->faker->randomFloat(/** double_attributes **/);
        $contribuable = Contribuable::factory()->create();

        $response = $this->put(route('employe.update', $employe), [
            'salaire_base' => $salaire_base,
            'frais_deplacement' => $frais_deplacement,
            'contribuable_id' => $contribuable->id,
        ]);

        $employe->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($salaire_base, $employe->salaire_base);
        $this->assertEquals($frais_deplacement, $employe->frais_deplacement);
        $this->assertEquals($contribuable->id, $employe->contribuable_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $employe = Employe::factory()->create();

        $response = $this->delete(route('employe.destroy', $employe));

        $response->assertNoContent();

        $this->assertModelMissing($employe);
    }
}
