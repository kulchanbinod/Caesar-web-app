<?php 

$app->group('/api', function ($app) {

	$app->get('/pizzas', function ($request, $response) {
		return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode(['error'=>false,'data'=>\App\Models\Pizza::with('ingredients','category')->get()]));
	});

	$app->post('/login', function ($request, $response) {
		$data = $request->getParsedBody();
		$username = $data['username'];
		$password = $data['password'];
		
		$user = \App\Models\User::where([
		    ['username', '=', $username],
		    ['password', '=', sha1($password)]
		   ])->first();

		if ($user) {
			return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode(['error'=>false,'data'=>$user]));
		}

		return $response->withStatus(400)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode(['error'=>true,'data'=>null]));
	});
	$app->post('/signup', function ($request, $response) {
		$data = $request->getParsedBody();

		$insert = [
			'name' => $data['name'],
			'email' => $data['email'],
			'phone' => $data['phone'],
			'username' => $data['username'],
			'address' => '',
			'created_at' => (new \DateTime())->format('Y-m-d H:i:s'),
			'password' => sha1($data['password'])
		];
		
		$user = \App\Models\User::create($insert);

		unset($user->password);

		return $response->withStatus(200)
                ->withHeader('Content-Type', 'application/json')
                ->write(json_encode($user));
	});
    $app->post('/users', function ($request, $response) {
    	$data = $request->getParsedBody();
	});
    $app->get('/users', function ($id) {
    	return \App\Models\User::get()->toJSON();
    });
});