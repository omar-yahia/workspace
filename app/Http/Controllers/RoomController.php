<?php

namespace App\Http\Controllers;

use App\Room;
use App\Space;
use http\Exception\BadConversionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RoomController extends Controller
{


//    Authentication
    public function __construct()
    {
        $this->middleware('auth')->except('showSpaceRooms');
    }


//    public function paginateFunction($items, $perPage = 5, $page = null, $options = [])
//    {
//        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
//        $items = $items instanceof Collection ? $items : Collection::make($items);
//        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
//    }


//    get all rooms
    public function index()
    {
//        If Admin
        if (Auth::user()->user_type == 1) {
            $rooms = Room::paginate(5);
        } //        If Owner
        elseif (Auth::user()->user_type == 2) {


            $rooms = new Collection();

            $spacesOfThisOwner = Space::where('owner_user_id', Auth::user()->user_id)->get();

            foreach ($spacesOfThisOwner as $space) {
                $rooms = $rooms->merge(Room::where('space_id', $space->space_id)->get());

            }

//            $rooms = self::paginateFunction($rooms, $perPage = 5, $page = null, $options = []);

        } else {
            return back();
        }

        return view('workspace.cruds.roomCrud', compact('rooms','spacesOfThisOwner'));
    }


    public function showSpaceRooms($spaceId)
    {
        $rooms = Room::where('space_id', '=', $spaceId)->get();
        return view('workspace.pages.reserveSpace', compact('rooms'));
    }


    public function create(Request $request)
    {


        $space = Space::where('space_name', $request->input('space_name'))->get()->first();

        if (isset($space)) {
            if (($space->owner_user_id == Auth::user()->user_id) || (Auth::user()->user_type == 1)) {


                $this->validate($request, [
                    'space_name' => 'required|string',
                    'room_name' => 'required|string',
                    'available_chairs' => 'required|numeric',
                    'chair_price_per_hour' => 'required|numeric',
                    'room_image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);


                $newRoom = new Room();

//                if ($request->hasFile('room_image_path')) {

                $ImageFile = $request->file('room_image_path');
                $destinationPath = public_path('/images');
                $radomNumber = rand(1, 90);
                $ImageName = $radomNumber . $ImageFile->getClientOriginalName();
                $ImageFile->move($destinationPath, $ImageName);

                $newRoom->room_image_path = $ImageName;
//                }
//                else {
//                    $newRoom->room_image_path = 'defaultRoomImage1.jpg';
//                }


                $newRoom->room_id = $request->input('room_id');
                $newRoom->space_id = $space->space_id;
                $newRoom->room_name = $request->input('room_name');
                $newRoom->available_chairs = $request->input('available_chairs');
                $newRoom->chair_price_per_hour = $request->input('chair_price_per_hour');


                $newRoom->save();


//                return redirect('showOwnerHisClientsReservations');
            }
//            else{
//                return err("You Don't owe this space , or the space name is incorrect!");
//            }

        }

        return back();
    }


    public function edit($roomId)
    {

        $room = Room::find($roomId);
        $owner_id = $room->space->user->user_id;

        if ((Auth::user()->user_id == $owner_id) || (Auth::user()->user_type == 1)) {
            return view('workspace.cruds.editRoom', compact('room'));
        }

        return back();
    }


    public function update(Request $request)
    {


        $room = Room::find($request->room_id);

        if (isset($room)) {

            $owner_id = $room->space->user->user_id;

            if ((Auth::user()->user_id == $owner_id) || (Auth::user()->user_type == 1)) {

                $this->validate($request, [
                    'room_id' => 'required|numeric',
                    'space_name' => 'required|string',
                    'room_name' => 'required|string',
                    'available_chairs' => 'required|numeric|min:3',
                    'chair_price_per_hour' => 'required|numeric',
                    'room_image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $space = Space::where('space_name', $request->space_name)->get()->first();


                if ($request->hasFile('room_image_path')) {
                    $ImageFile = $request->file('room_image_path');
                    $destinationPath = public_path('/images');
                    $radomNumber = rand(1, 90);
                    $ImageName = $radomNumber . $ImageFile->getClientOriginalName();
                    $ImageFile->move($destinationPath, $ImageName);

                    $room->room_image_path = $ImageName;
                }


                $room->room_id = $request->input('room_id');
                $room->space_id = $space->space_id;
                $room->room_name = $request->input('room_name');
                $room->available_chairs = $request->input('available_chairs');
                $room->chair_price_per_hour = $request->input('chair_price_per_hour');
//        $room->room_image_path= $ImageName;

                $room->save();

                return redirect('roomCrud');

            }

        }


        return back();
    }


    public function destroy($roomId)
    {
        $room = Room::find($roomId);

        $owner_id = $room->space->user->user_id;

        if ((Auth::user()->user_id == $owner_id) || (Auth::user()->user_type == 1)) {
            $room->delete();
            return back()->with('deleted', 'Deleted');
        }
        return back();
    }


}





//
//            $rooms = [];
//            $spacesOfThisOwner = Space::where('owner_user_id', Auth::user()->user_id)->get();
//
//            foreach ($spacesOfThisOwner as $space) {
//                $roomsToAdd = Room::where('space_id', $space->space_id)->get()->all();
////                $roomsToAdd = Room::where('space_id', $space->space_id)->paginate(5);
//
//                $rooms = array_merge($rooms, $roomsToAdd);
//
//            }

//            $Topic = new Topic();
//            $Topic::hydrate($result);

//            $roomsFinal = new Room();
//            $roomsFinal::hydrate($rooms);
//            return $roomsFinal;
