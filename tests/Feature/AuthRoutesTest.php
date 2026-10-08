<?php

it('renders the login link in the guest navbar', function () {
    $view = $this->view('layouts.app');

    $view->assertSee('href="'.route('login').'"', false);
});

it('renders the login page with a form that posts to the login endpoint', function () {
    $response = $this->get('/login');

    $response->assertSee('action="'.url('/login').'"', false);
});

it('validates credentials submitted to the login endpoint', function () {
    $response = $this->post('/login', []);

    $response->assertSessionHasErrors(['email', 'password']);
});

it('redirects guests who attempt to log out to the login page', function () {
    $response = $this->post('/logout');

    $response->assertRedirect('/login');
    $response->assertSessionMissing('success');
});
