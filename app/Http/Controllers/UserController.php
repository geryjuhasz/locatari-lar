<?php 

use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use Sentinel\Repositories\User\SentinelUserRepositoryInterface;
use Sentinel\Repositories\Group\SentinelGroupRepositoryInterface;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = Sentinel::getUserRepository()->createModel()->paginate(15);
		return View::make('users.index')->with('users', $users);
        //return $this->view('Sentinel::users.index', ['users' => $users]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserCreateRequest $request)
	{
		// Create and store the new user
        $result = $this->userRepository->store($request->all());
        //$result = $this->create($request->all());
        // Determine response message based on whether or not the user was activated
        $message = ($result->getPayload()['activated'] ? trans('Sentinel::users.addedactive') : trans('Sentinel::users.added'));

        // Finished!
        return $this->redirectTo('users_store', ['success' => $message]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
