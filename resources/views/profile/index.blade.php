@extends('layouts.app')
@section('content')
    <div class="container table-responsive my-3">
        <h1 class="text-center text-white mb-5">My Account</h1>

        <h2 class="text-center text-white mb-2">Game Progress</h2>
        <table class="table table-dark table-striped table-bordered mt-3">
            <thead>
                <tr class="text-center">
                    <th>Level Name</th>
                    <th>Progress (%)</th>
                    <th>Health</th>
                    <th>Weapons</th>
                    <th>Monsters Killed</th>
                    <th>Total Deaths</th>
                </tr>

            </thead>
            <tbody>
                <tr class="text-center">
                    <td>
                        <p id="buildIndex">
                            @if (Auth::user()->buildIndex == 3)
                                {{ __('Gates of Life') }}
                            @elseif (Auth::user()->buildIndex == 5)
                                {{ __('Haunted Acre Woods') }}
                            @elseif (Auth::user()->buildIndex == 7)
                                {{ __('Asylum') }}
                            @elseif (Auth::user()->buildIndex == 10)
                                {{ __('Village of Souls') }}
                            @elseif (Auth::user()->buildIndex == 13)
                                {{ __('Phantom Theater') }}
                            @elseif (Auth::user()->buildIndex == 16)
                                {{ __('Ghost Lake') }}
                            @elseif (Auth::user()->buildIndex == 19)
                                {{ __('Escape Tunnel') }}
                            @elseif (Auth::user()->buildIndex == 22)
                                {{ __('Murdered Town') }}
                            @elseif (Auth::user()->buildIndex == 25)
                                {{ __('Disturbed Graves') }}
                            @elseif (Auth::user()->buildIndex == 28)
                                {{ __('Hollowed Train') }}
                            @elseif (Auth::user()->buildIndex == 30)
                                {{ __('Game is Finished. Thanks for Playing') }}
                            @else
                                {{ __('Waiting to Start Game') }}
                            @endif
                        </p>

                    </td>
                    <td>
                        <p id="progress">{{ Auth::user()->progress }}%</p>

                    </td>
                    <td>
                        <p id="health">{{ Auth::user()->health }}%</p>

                    </td>
                    <td>
                        <p id="weapons">
                            @if (Auth::user()->hasPistol == 'True' && Auth::user()->hasAxe == 'False')
                                {{ __('Pistol') }}
                            @elseif(Auth::user()->hasPistol == 'False' && Auth::user()->hasAxe == 'True')
                                {{ __('Axe') }}
                            @elseif(Auth::user()->hasPistol == 'True' && Auth::user()->hasAxe == 'True')
                                {{ __('Pistol & Axe') }}
                            @else
                                {{ __('No weapon') }}
                            @endif
                        </p>

                    </td>
                    <td>
                        <p id="monsterKilled">{{ Auth::user()->monsterKilled }}</p>

                    </td>
                    <td>
                        <p id="deathCount">{{ Auth::user()->deathCount }}</p>

                    </td>
                </tr>
            </tbody>
        </table>

    </div>
    @php
    function replace_string(string $str, string $char = 'xxx', int $number = 10)
    {
        echo substr($str, 0, -$number) . str_repeat($char, $number);
    }
    @endphp
    <div class="container my-5">
        <h2 class="text-center text-white mb-5">Account Details</h2>
        @if (session()->has('_message'))
            <p class="text-center alert alert-info">{{ session()->get('_message') }}</p>
        @endif
        <form action="{{ route('profile.updateUserInfo') }}" method="post" class="text-white">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ Auth::id() }}">
            <div class="row my-3">
                <div class="col-6">
                    <label>Username <small>(You cannot change your username)</small></label>
                    <input type="text" class="form-control" value="{{ old('fname', Auth::user()->username) }}"
                        disabled>
                </div>
                <div class="col-6">
                    <label>Password</label><br>
                    <button type="button" id="setPass" onclick="$('#setNewPass').modal('show')"
                        class="btn btn-outline-primary">Set New Password</button>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12">
                    <label>E-mail</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('fname', Auth::user()->email) }}" required>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-6">
                    <label>First Name</label>
                    <input type="text" name="fname" class="form-control"
                        value="{{ old('fname', Auth::user()->fname) }}" required>
                </div>
                <div class="col-6">
                    <label>Last Name</label>
                    <input type="text" name="lname" class="form-control"
                        value="{{ old('lname', Auth::user()->lname) }}" required>
                </div>
            </div>
            <div class="row my-5">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Update Your Info</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container my-5"></div>
    <script>
        $(() => {
            setInterval(() => {
                var id = {{ Auth::id() }};

                $.ajax({
                    url: "{{ route('profile.fetch') }}",
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    dataType: 'json',
                    success: (data) => {
                        //console.log(data);
                        var buildIndex = data.buildIndex;
                        var progress = data.progress;
                        var health = data.health;
                        var hasPistol = data.hasPistol;
                        var hasAxe = data.hasAxe;
                        var monsterKilled = data.monsterKilled;
                        var deathCount = data.deathCount;

                        $("#progress").text(progress + "%");
                        $("#health").text(health + "%");
                        $("#monsterKilled").text(monsterKilled);
                        $("#deathCount").text(deathCount);

                        if (buildIndex == "3") {
                            $("#buildIndex").text("Gates of Life");
                        } else if (buildIndex == "5") {
                            $("#buildIndex").text("Haunted Acre Woods");
                        } else if (buildIndex == "7") {
                            $("#buildIndex").text("Asylum");
                        } else if (buildIndex == "10") {
                            $("#buildIndex").text("Village of Souls");
                        } else if (buildIndex == "13") {
                            $("#buildIndex").text("Phantom Theater");
                        } else if (buildIndex == "16") {
                            $("#buildIndex").text("Ghost Lake");
                        } else if (buildIndex == "19") {
                            $("#buildIndex").text("Escaped Tunnel");
                        } else if (buildIndex == "22") {
                            $("#buildIndex").text("Murdered Town");
                        } else if (buildIndex == "25") {
                            $("#buildIndex").text("Disturbed Graves");
                        } else if (buildIndex == "28") {
                            $("#buildIndex").text("Hollowed Train");
                        } else if (buildIndex == "30") {
                            $("#buildIndex").text("Game is Finished. Thanks for Playing");
                        } else {
                            $("#buildIndex").text("Waiting to Start Game");
                        }

                        if (hasPistol == "True" && hasAxe == "False") {
                            $("#weapons").text("Pistol");
                        } else if (hasPistol == "False" && hasAxe == "True") {
                            $("#weapons").text("Axe");
                        } else if (hasPistol == "True" && hasAxe == "True") {
                            $("#weapons").text("Pistol & Axe");
                        } else {
                            $("#weapons").text("No Weapons");
                        }
                    }
                });


                // console.log("RUnning");
            }, 5000);

            setTimeout(() => {
                $(".alert").fadeOut("slow");
            }, 5000);
        });
    </script>



    <div class="modal fade" id="setNewPass">
        <div class="modal-dialog modal-dialog-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Set New Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3">
                            <label for="currentPass">Current Password</label>
                            <div class="col-12 mt-2">
                                <input type="password" name="currentPass" id="currentPass" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="currentPass">New Password</label>
                            <div class="col-12 mt-2">
                                <input type="password" name="newPass" id="newPass" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="currentPass">Confirm Password</label>
                            <div class="col-12 mt-2">
                                <input type="password" name="confirmPass" id="confirmPass" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(() => {
            $("#btnSave").on('click', () => {
                var currentPass = $("#currentPass").val();
                var newPass = $("#newPass").val();
                var confirmPass = $("#confirmPass").val();
                if(currentPass == "" || newPass == "" || confirmPass == "")
                {
                    Swal.fire({
                        title: "Error",
                        text: "Please fill out the remaining fields",
                        icon: "error",
                    });
                }
                else if (newPass != confirmPass) {
                    Swal.fire({
                        title: "Error",
                        text: "Password do not match",
                        icon: "error",
                    });
                } else {
                    $.ajax({
                        url: "{{route('user.passwordUpdate')}}",
                        type: 'post',
                        data: {
                            currentPass: currentPass,
                            newPass: newPass,
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "html",
                        success: (data) => {
                            if (data == "1") {
                                Swal.fire({
                                    title: "Suceess",
                                    text: "Password successfully updated",
                                    icon: "success",
                                    allowOutsideClick: false,
                                    allowEscapeKey: false
                                }).then((res) => {
                                    if (res.isConfirmed) {
                                        window.location.reload();
                                    }
                                });
                            }
                            else if(data == "2")
                            {
                                Swal.fire({
                                    title: "Error",
                                    text: "Incorrect Password",
                                    icon: "error"
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    title: "Unexpected Error",
                                    text: "An Unexpected Error Occurred.",
                                    icon: "error"
                                });
                            }
                        }
                    });
                }

            });
        });
    </script>
@endsection
