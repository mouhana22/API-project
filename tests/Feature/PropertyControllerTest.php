<?php

/**
 * Mouhana Almouhana
 * MouhanaAlmouhana@gmail.com
 */

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Property;

class PropertyControllerTest extends TestCase
{
    use RefreshDatabase;

    //index function testing
    public function testIndex()
    {
        // Create 3 property records using factory
        Property::factory()->count(3)->create();

        // Make a GET request to fetch all properties
        $response = $this->get('/api/properties');

        // Assert the response status is 200 and follows the expected JSON structure
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'address',
                        'price',
                        'bedrooms',
                        'bathrooms',
                        'type',
                        'status',
                        'created_at',
                        'updated_at',
                    ],
                ],
            ]);
    }

    // Store function testing
    public function testStore()
    {
        // Sample property data
        $data = [
            'title' => 'test Property',
            'address' => 'test Address',
            'price' => 100.50,
            'bedrooms' => 2,
            'bathrooms' => 1,
            'type' => 'apartment',
            'status' => 'available',
        ];

        // Make a POST request to create a new property
        $response = $this->postJson('/api/properties', $data);

        // Assert the response status is 201 and follows the expected JSON structure
        $response->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'address',
                    'price',
                    'bedrooms',
                    'bathrooms',
                    'type',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    // Show function testing
    public function testShow()
    {
        // Create a property using factory
        $property = Property::factory()->create();

        // Make a GET request to fetch a specific property by ID
        $response = $this->get("/api/properties/{$property->id}");

        // Assert the response status is 200 and follows the expected JSON structure
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'title',
                    'address',
                    'price',
                    'bedrooms',
                    'bathrooms',
                    'type',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    // Update function testing
    public function testUpdate()
    {
        // Create a property using factory
        $property = Property::factory()->create();

        // Updated property data
        $data = [
            'title' => 'Updated Title',
            'address' => 'Updated Address',
            'price' => 150.75,
            'bedrooms' => 3,
            'bathrooms' => 2,
            'type' => 'villa',
            'status' => 'sold',
        ];

        // Make a PUT request to update a property by ID
        $response = $this->putJson("/api/properties/{$property->id}/update", $data);

        // Assert the response status is 200 and follows the expected JSON structure
        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $property->id,
                    'title' => 'Updated Title',
                    'address' => 'Updated Address',
                    'price' => 150.75,
                    'bedrooms' => 3,
                    'bathrooms' => 2,
                    'type' => 'villa',
                    'status' => 'sold',
                    'created_at' => $property->created_at->format('Y-m-d H:i:s'),
                    'updated_at' => $property->updated_at->format('Y-m-d H:i:s'),
                ],
            ]);
    }

    // Destroy function testing
    public function testDestroy()
    {
        // Create a property using factory
        $property = Property::factory()->create();

        // Make a DELETE request to delete a property by ID
        $response = $this->delete("/api/properties/{$property->id}/destroy");

        // Assert the response status is 204
        $response->assertStatus(204);
    }
}

