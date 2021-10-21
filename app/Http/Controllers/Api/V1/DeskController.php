<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DeskStoreRequest;
use App\Http\Resources\Api\DeskResource;
use \App\Models\Desk;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DeskResource::collection(Desk::all());
    }

    /**
     * @OA\Post(
     * path="/api/v1/desk",
     * summary="Add user in table `desk`",
     * description="Добавить пользователя",
     * operationId="AddUser",
     * tags={"Dask"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Создайте пользователя для таблицы desk",
     *    @OA\JsonContent(
     *       required={"name"},
     *       @OA\Property(property="name", type="string", example="Naimjon"),
     *    ),
     * ),
     * @OA\Response(
     *    response=201,
     *    description="Successful Response",
     *    @OA\JsonContent(
     *       @OA\Property(property="id", type="integer", example="10"),
     *       @OA\Property(property="name", type="string", maxLength=255, example="Naimjon"),
     *       @OA\Property(property="created_at", type="string", example="2021-10-21T17:12:39.000000Z"),
     *       @OA\Property(property="lists", type="array", @OA\Items()),
     *     )
     *  )
     * )
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeskStoreRequest $request)
    {
        $created_desk = Desk::create($request->validated());

        return response()->json(new DeskResource($created_desk), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Desk $desk)
    {
        return new DeskResource($desk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeskStoreRequest $request, Desk $desk)
    {
        $desk->update($request->validated());

        return response()->json(new DeskResource($desk), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desk $desk)
    {
        $desk->delete();

        return response()->noContent();
    }
}
