<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_can_create_a_task()
    {
        $data = [
            'name' => 'Test Task'
        ];

        $response = $this->post(route('tasks.store'), $data);

        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task',
            'done' => false
        ]);

        $response->assertRedirect(route('tasks.index'));
    }

    /** @test */
    public function it_can_mark_a_task_as_done()
    {
        $task = Task::factory()->create(['done' => false]);

        $response = $this->put(route('tasks.markAsDone', $task));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'done' => true
        ]);

        $response->assertRedirect(route('tasks.index'));
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->delete(route('tasks.destroy', $task));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);

        $response->assertRedirect(route('tasks.index'));
    }
}
