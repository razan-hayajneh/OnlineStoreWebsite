<?php namespace Tests\Repositories;

use App\Models\SocialMedia;
use App\Repositories\SocialMediaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SocialMediaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SocialMediaRepository
     */
    protected $socialMediaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->socialMediaRepo = \App::make(SocialMediaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_social_media()
    {
        $socialMedia = SocialMedia::factory()->make()->toArray();

        $createdSocialMedia = $this->socialMediaRepo->create($socialMedia);

        $createdSocialMedia = $createdSocialMedia->toArray();
        $this->assertArrayHasKey('id', $createdSocialMedia);
        $this->assertNotNull($createdSocialMedia['id'], 'Created SocialMedia must have id specified');
        $this->assertNotNull(SocialMedia::find($createdSocialMedia['id']), 'SocialMedia with given id must be in DB');
        $this->assertModelData($socialMedia, $createdSocialMedia);
    }

    /**
     * @test read
     */
    public function test_read_social_media()
    {
        $socialMedia = SocialMedia::factory()->create();

        $dbSocialMedia = $this->socialMediaRepo->find($socialMedia->id);

        $dbSocialMedia = $dbSocialMedia->toArray();
        $this->assertModelData($socialMedia->toArray(), $dbSocialMedia);
    }

    /**
     * @test update
     */
    public function test_update_social_media()
    {
        $socialMedia = SocialMedia::factory()->create();
        $fakeSocialMedia = SocialMedia::factory()->make()->toArray();

        $updatedSocialMedia = $this->socialMediaRepo->update($fakeSocialMedia, $socialMedia->id);

        $this->assertModelData($fakeSocialMedia, $updatedSocialMedia->toArray());
        $dbSocialMedia = $this->socialMediaRepo->find($socialMedia->id);
        $this->assertModelData($fakeSocialMedia, $dbSocialMedia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_social_media()
    {
        $socialMedia = SocialMedia::factory()->create();

        $resp = $this->socialMediaRepo->delete($socialMedia->id);

        $this->assertTrue($resp);
        $this->assertNull(SocialMedia::find($socialMedia->id), 'SocialMedia should not exist in DB');
    }
}
