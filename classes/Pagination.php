<?php
namespace Classes;

class Pagination {
  public $actual_page;
  public $records_per_page;
  public $total_records;


  public function __construct($actual_page = 1, $records_per_page = 10, $total_records = 0) {
    $this->actual_page = (int) $actual_page;
    $this->records_per_page = (int) $records_per_page;
    $this->total_records = (int) $total_records;
  }

  public function offset() {
    return $this->records_per_page * ($this->actual_page - 1);
  }

  public function total_pages() {
    $total = ceil($this->total_records / $this->records_per_page);
    $total == 0 ? $total = 1 : $total = $total;
    return $total;
  }

  public function previous_page() {
    $previous = $this->actual_page - 1;
    return ($previous > 0) ? $previous : false;
  }

  public function next_page() {
    $next = $this->actual_page + 1;
    return ($next <= $this->total_pages()) ? $next : false;
  }

  public function previous_link() {
    $html = '';
    if($this->previous_page()) {
      $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->previous_page()}\">&laquo; Anterior</a>";
    }
    return $html;
  }

  public function next_link() {
    $html = '';
    if($this->next_page()) {
      $html .= "<a class=\"pagination__link pagination__link--text\" href=\"?page={$this->next_page()}\">Siguiente &raquo;</a>";
    }
    return $html;
  }

  public function page_numbers() {
    $html = '';
    for($i = 1; $i <= $this->total_pages(); $i++) {
      if ($i === $this->actual_page) {
        $html .= "<span class=\"pagination__link pagination__link--actual\">{$i}</span>";
      } else {
        $html .= "<a class=\"pagination__link pagination__link--number\" href=\"?page={$i}\">{$i}</a>";
      }
    }


    return $html;
  }

  public function pagination() {
    $html = '';
    if($this->total_records > 1) {
      $html .= '<div class="pagination">';
      $html .= $this->previous_link();
      $html .= $this->page_numbers();
      $html .= $this->next_link();
      $html .= '</div>';
    }
    return $html;
  }
}
?>