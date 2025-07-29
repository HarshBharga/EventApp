<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class ManageEvent extends Component
{

    public $events;
    public $title, $description, $date, $time, $location;
    public $isEdit = false;
    public $showModal = false;
    public $showDeleteModal = false;
    public $eventIdForDelete;
    public $eventIdForEdit;


    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = \App\Models\Event::orderBy('date')->get();
    }

    public function render()
    {
        return view('livewire.manage-event');
    }

    public function openModalForCreate()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function openModalForEdit($id)
    {
        $this->resetForm();
        $this->isEdit = true;
        $event = \App\Models\Event::findOrFail($id);
        $this->eventIdForEdit = $id;
        $this->title = $event->title;
        $this->description = $event->description;
        $this->date = $event->date;
        $this->time = $event->time;
        $this->location = $event->location;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required|string|max:255',
        ]);

        if ($this->isEdit) {
            $event = \App\Models\Event::findOrFail($this->eventIdForEdit);
            $event->update([
                'title' => $this->title,
                'description' => $this->description,
                'date' => $this->date,
                'time' => $this->time,
                'location' => $this->location,
            ]);
            session()->flash('success', 'Event updated successfully!');
        } else {
            \App\Models\Event::create([
                'title' => $this->title,
                'description' => $this->description,
                'date' => $this->date,
                'time' => $this->time,
                'location' => $this->location,
            ]);
            session()->flash('success', 'Event created successfully!');
        }

        $this->showModal = false;
        $this->loadEvents();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['title', 'description', 'date', 'time', 'location', 'eventIdForEdit']);
        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->eventIdForDelete = $id;
        $this->showDeleteModal = true;
    }

    public function deleteConfirmed()
    {
        \App\Models\Event::findOrFail($this->eventIdForDelete)->delete();
        session()->flash('success', 'Event deleted successfully!');
        $this->showDeleteModal = false;
        $this->loadEvents();
    }
}
