<?php

namespace Model;

class Event extends ActiveRecord {
    protected static $table = 'events';
    protected static $columnsDB = ['id', 'event_name', 'description', 'date', 'hour', 'location', 'link', 'category_id', 'speaker_id'];

    public $id;
    public $event_name;
    public $description;
    public $category_id;
    public $date;
    public $speaker_id;
    public $hour;
    public $location;
    public $link;

    public function __construct($args = [])
    {   $this->id = $args['id'] ?? null;
        $this->event_name = $args['event_name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->category_id = $args['category_id'] ?? '';
        $this->date = $args['date'] ?? '';
        $this->speaker_id = $args['speaker_id'] ?? '';
        $this->hour = $args['hour'] ?? '';
        $this->location = $args['location'] ?? '';
        $this->link = $args['link'] ?? '';
    }

    // Mensajes de validación para la creación de un evento
    public function validate() {
        if(!$this->event_name) {
            self::$alerts['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->description) {
            self::$alerts['error'][] = 'La descripción es Obligatoria';
        }
        if(!$this->category_id  || !filter_var($this->category_id, FILTER_VALIDATE_INT)) {
            self::$alerts['error'][] = 'Elige una Categoría';
        }
        if(!$this->date) {
            self::$alerts['error'][] = 'El día es obligatorio';
        }
        if(!$this->hour) {
            self::$alerts['error'][] = 'La hora es obligatoria';
        }
        if(!$this->location) {
            self::$alerts['error'][] = 'La ubicación es obligatoria';
        }
        if(!$this->link) {
            self::$alerts['error'][] = 'El link es Obligatorio';
        }
        if(!$this->speaker_id || !filter_var($this->speaker_id, FILTER_VALIDATE_INT) ) {
            self::$alerts['error'][] = 'Selecciona la persona encargada del evento';
        }
        return self::$alerts;
    }

}