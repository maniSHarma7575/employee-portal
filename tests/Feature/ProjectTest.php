<?php

namespace Tests\Feature;

class ProjectTest extends FeatureTest
{
    /** @test */
    public function an_authorized_user_can_see_projects()
    {
        $this->signInAsSuperAdmin();
        $this->get(route('projects'))
            ->assertStatus(200);
    }

    /** @test */
    public function an_unauthorized_user_cant_see_projects()
    {
        $this->withoutExceptionHandling()
            ->expectException('Illuminate\Auth\Access\AuthorizationException');
        $this->signIn();
        $this->get(route('projects'));
    }

    /** @test */
    public function a_guest_cant_see_projects()
    {
        $this->get(route('projects'))
            ->assertRedirect('login');
    }

    /** @test */
    public function an_authorized_user_can_create_a_project()
    {
        $this->signInAsSuperAdmin();
        $project = make('App\Models\Project');
        $response = $this->post(route('projects.store'), $project->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($project->name);
    }

    /** @test */
    public function an_authorized_user_can_update_a_project()
    {
        $this->signInAsSuperAdmin();
        $project = create('App\Models\Project');
        $this->get(route('projects.edit', $project->id))
            ->assertSee($project->name);
        $newProject = create('App\Models\Project');
        $this->patch(route('projects.update', $project->id), $newProject->toArray());
        $this->get(route('projects.edit', $project->id))
            ->assertSee($newProject->name);
    }
}
