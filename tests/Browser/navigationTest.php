<?php

namespace Tests\Browser;

use App\Models\Program;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class navigationTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Texas');
        });
    }

    public function testEtplByCity(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('list-of-cities')
                ->assertSee('Corpus Christi')
                ->assertSee('San Antonio')
                ->assertSee('Austin')
                ->assertSee('Houston');
        });
    }

    public function testAbout(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('about')
                ->assertSee('Average Cost of Tuition')
                ->assertSee('# Of Cities')
                ->assertSee('# Of Programs');
        });
    }

    /**
     * basically load all programs, and then visit their slug url, and then try to click on
     * the program_url link..
     *
     * @return void
     */
    //    public function test_program_urls()
    //    {
    //        $programs = Program::all()->take(5);
    //
    //        foreach($programs AS $program) {
    //
    //            $this->browse(function (Browser $browser) use ($program) {
    //                $browser->visit($program->program_slug)
    //                    ->clickLink($program->program_name)
    //                    ->assertSeeLink($program->program_name);
    //                 #   ->assertTitleContains('TX');
    //
    //            });
    //
    //
    //        }
    //
    //    }

}
