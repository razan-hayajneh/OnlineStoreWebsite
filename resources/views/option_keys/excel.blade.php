<!DOCTYPE html>
<html>

<head>
    <title>{{ __('awt.option_keys') }}</title>
</head>
<style>
    table,
    td,
    th,
    tr,
    td {
        border: 1px solid rgb(3, 3, 3);
        text-align: center;
        font-size: smaller;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 15px;
    }

    h1,
    img {
        font-size: medium;
        text-align: center;

    }

    .img-contanier {
        text-align: center;
    }

    .test {
        max-width: 20px;
        height: auto;
    }
</style>

<body>

    <div class="table-responsive">
        {{-- <td  class="text-center"style="text-align: center; " colspan="2" >
            <img src="logo/logo-h.png"  width="200">
        </td> --}}


        {{-- <td class="text-center"style="text-align: center; font-size:15px ;" colspan="6" ><b
                style="text-align: center"> {{__('awt.cities')}}
                </b>

            </td> --}}




        <tr />
        <tr />
<tr><td>{{ __('awt.Option Name') }}:</td><td>{{$option->name}}</td></tr>

<tr />
        <div class="table-responsive-sm">

            <table class="table pt-5" id="student-table">
                <thead>
                    <tr>
                        <th style="width: 110px; text-align:center;background-color:#D7DBDF">#
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">{{ __('awt.key') }}
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($optionKeys as $ob)
                        <tr>
                            <td>{{ $ob->id }}</td>

                            <td>{{ $ob->key }}</td>
                        </tr>
                    @endforeach

                </tbody>


            </table>


        </div>
    </div>
</body>

</html>
