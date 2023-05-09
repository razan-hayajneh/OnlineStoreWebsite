<!DOCTYPE html>
<html>

<head>
    <title>{{ __('models/clients.plural') }}</title>
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
                style="text-align: center"> {{__('awt.المدن')}}
                </b>

            </td> --}}




        <tr />
        <tr />

        <div class="table-responsive-sm">

            <table class="table pt-5" id="order-table">
                <thead>
                    <tr>
                        {{-- <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/clients.fields.avatar') }}
                        </th> --}}
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">{{ __('awt.name') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/clients.fields.email') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/clients.fields.phone') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/clients.fields.replace_phone') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/clients.fields.user_status') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/clients.fields.city_id') }}
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $ob)
                        <tr>
                            {{-- <td style="text-align: center"><img src="{{ dashboard_url($ob['avatar']) }}"
                                    style="width: 50%;height: 50%;border-radius: 100px;"></td> --}}
                            <td style="text-align: center">{{ $ob->name }}</td>
                            <td style="text-align: center">{{ $ob->email }}</td>
                            <td style="text-align: center">{{ $ob->phone }}</td>
                            <td style="text-align: center">{{ $ob->replace_phone }}</td>
                            <td style="text-align: center">{{ $ob->userStatus?->name }}</td>
                            <td style="text-align: center">
                                {{ $ob->country?->name . ($ob->city ? '-' . $ob->city?->name : '') }}</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
