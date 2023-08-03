<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Contribuable;
use App\Models\Employe;
use App\Models\PaimentIpr;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PaimentIprController
 */
class PaimentIprControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected(): void
    {
        $paimentIprs = PaimentIpr::factory()->count(3)->create();

        $response = $this->get(route('paiment-ipr.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaimentIprController::class,
            'store',
            \App\Http\Requests\PaimentIprStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves(): void
    {
        $contribuable = Contribuable::factory()->create();
        $employe = Employe::factory()->create();
        $date_paiement = $this->faker->date();
        $montant_employe = $this->faker->randomFloat(/** double_attributes **/);
        $montant_employeur = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->post(route('paiment-ipr.store'), [
            'contribuable_id' => $contribuable->id,
            'employe_id' => $employe->id,
            'date_paiement' => $date_paiement,
            'montant_employe' => $montant_employe,
            'montant_employeur' => $montant_employeur,
        ]);

        $paimentIprs = PaimentIpr::query()
            ->where('contribuable_id', $contribuable->id)
            ->where('employe_id', $employe->id)
            ->where('date_paiement', $date_paiement)
            ->where('montant_employe', $montant_employe)
            ->where('montant_employeur', $montant_employeur)
            ->get();
        $this->assertCount(1, $paimentIprs);
        $paimentIpr = $paimentIprs->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected(): void
    {
        $paimentIpr = PaimentIpr::factory()->create();

        $response = $this->get(route('paiment-ipr.show', $paimentIpr));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PaimentIprController::class,
            'update',
            \App\Http\Requests\PaimentIprUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected(): void
    {
        $paimentIpr = PaimentIpr::factory()->create();
        $contribuable = Contribuable::factory()->create();
        $employe = Employe::factory()->create();
        $date_paiement = $this->faker->date();
        $montant_employe = $this->faker->randomFloat(/** double_attributes **/);
        $montant_employeur = $this->faker->randomFloat(/** double_attributes **/);

        $response = $this->put(route('paiment-ipr.update', $paimentIpr), [
            'contribuable_id' => $contribuable->id,
            'employe_id' => $employe->id,
            'date_paiement' => $date_paiement,
            'montant_employe' => $montant_employe,
            'montant_employeur' => $montant_employeur,
        ]);

        $paimentIpr->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($contribuable->id, $paimentIpr->contribuable_id);
        $this->assertEquals($employe->id, $paimentIpr->employe_id);
        $this->assertEquals(Carbon::parse($date_paiement), $paimentIpr->date_paiement);
        $this->assertEquals($montant_employe, $paimentIpr->montant_employe);
        $this->assertEquals($montant_employeur, $paimentIpr->montant_employeur);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with(): void
    {
        $paimentIpr = PaimentIpr::factory()->create();

        $response = $this->delete(route('paiment-ipr.destroy', $paimentIpr));

        $response->assertNoContent();

        $this->assertModelMissing($paimentIpr);
    }
}
