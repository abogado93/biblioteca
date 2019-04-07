<?php

/**
 * Created by PhpStorm.
 * User: crojas
 * Date: 2/6/18
 * Time: 16:27
 */
class Paginator
{
    private $totalRows, $rowsPerPage, $url, $page;

    public function __construct($totalRows, $rowsPerPage, $url, $page) {
        $this->rowsPerPage = $rowsPerPage;
        $this->url = $url;
        $this->totalRows = $totalRows;
        $this->page = $page;
    }

    public function getLimit() {
        return ($this->page - 1) * $this->rowsPerPage;
    }


    private function getLastPage() {
        return ceil($this->totalRows / $this->rowsPerPage);
    }

    public function showPage() {

        if ($this->totalRows <= $this->rowsPerPage) {
            return null;
        }

        $pagination = "";
        $counter = 0;

        $lpm1 = $this->getLastPage() - 1;

        $p = $this->page;

        $prev = $this->page - 1;
        $next = $this->page + 1;

        $pagination .= "<ul class=\"pagination\">";

        if ($this->getLastPage() > 1) {

            if ($p > 1) {
                $pagination .= "<li><a href=$this->url" . "p=" . $prev . ">&laquo; ant</a></li>";

            } else {
                $pagination .= "<li class=\"disabled\"><a href=\"\">&laquo; ant</a></li>";
            }

            if ($this->getLastPage() < 9) {

                for ($counter = 1; $counter <= $this->getLastPage(); $counter++) {

                    if ($counter == $p) {

                        $pagination .= "<li class=\"active\"><a href=\"\">" . $counter . "</a></li>";
                    } else {

                        $pagination .= "<li><a href=$this->url"."p=".$counter.">".$counter."</a></li>";
                    }
                }
            }

            elseif($this->getLastPage() >= 9) {

                if($p < 4) {

                    for ($counter = 1; $counter < 6; $counter++) {

                        if ($counter == $p) {

                            $pagination .= "<li class=\"active\"><a href=\"\">".$counter."</a></li>";
                        } else {

                            $pagination .= "<li><a href=$this->url"."p=".$counter."/>".$counter."</a></li>";
                        }
                    }

                    $pagination .= "<li class=\"disabled\"><a href=\"\">...</a><li>";
                    $pagination .= "<li><a href=$this->url"."p=".$lpm1.">".$lpm1."</a></li>";
                    $pagination .= "<li><a href=$this->url"."p=".$this->getLastPage().">".$this->getLastPage()."</a></li>";
                }

                elseif($this->getLastPage() - 3 > $p && $p > 1) {

                    $pagination .= "<li><a href=$this->url"."p=1>1</a></li>";
                    $pagination .= "<li><a href=$this->url"."p=2>2</a></li>";
                    $pagination .= "<li class=\"disabled\"><a href=\"\">...</a><li>";

                    for ($counter = $p - 1; $counter <= $p + 1; $counter++) {

                        if ($counter == $p) {

                            $pagination .= "<li class=\"active\"><a href=\"\">".$counter."</a></li>";
                        } else {

                            $pagination .= "<li><a href=$this->url"."p=".$counter.">".$counter."</a></li>";
                        }
                    }

                    $pagination .= "<li class=\"disabled\"><a href=\"\">...</a><li>";
                    $pagination .= "<li><a href=$this->url"."p=$lpm1>$lpm1</a></li>";
                    $pagination .= "<li><a href=$this->url"."p=".$this->getLastPage().">".$this->getLastPage()."</a></li>";
                }

                else {

                    $pagination .= "<li><a href=$this->url"."p=1>1</a></li>";
                    $pagination .= "<li><a href=$this->url"."p=2>2</a></li>";
                    $pagination .= "<li class=\"disabled\"><a href=\"\">...</a><li>";

                    for ($counter = $this->getLastPage() - 4; $counter <= $this->getLastPage(); $counter++) {
                        if ($counter == $p) {

                            $pagination .= "<li class=\"active\"><a href=\"\">".$counter."</a></li>";

                        } else {

                            $pagination .= "<li><a href=$this->url"."p=".$counter.">".$counter."</a></li>";
                        }
                    }
                }
            }

            if ($p < $counter - 1) {

                $pagination .= "<li><a href=$this->url"."p=".$next.">sig &raquo;</a></li>";

            } else {

                $pagination .= "<li class=\"disabled\"><a href=\"\">sig &raquo;</a></li>";
                $pagination .= "</ul>";
            }
        }

        return $pagination;
    }

}