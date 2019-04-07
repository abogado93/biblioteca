<?php

class Home extends Controller
{

    public function __construct() {
        parent::__construct(new ReflectionClass($this));
    }

    public function index() {

        Session::checkSession();

        $this->renderView('home/index.php');

    }

    public function list(?string ... $params) {
        throw new \RuntimeException("Method not available");
    }

    public function new() {
        throw new \RuntimeException("Method not available");
    }

    public function add() {
        throw new \RuntimeException("Method not available");
    }

    public function remove() {
        throw new \RuntimeException("Method not available");
    }

    public function modify() {
        throw new \RuntimeException("Method not available");
    }

    public function edit($id) {
        throw new \RuntimeException("Method not available");
    }

    public function query(?string ... $filters) {
        throw new \RuntimeException("Method not available");
    }
}