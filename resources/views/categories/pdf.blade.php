<!DOCTYPE html>
<html>

<head>
    <title>{{ awtTrans('categories') }}</title>
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


        <div class="table-responsive-sm">

            <table class="table pt-5" id="student-table">
                <thead>
                    <tr>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">#
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">{{ __('models/categories.fields.name') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            <b>{{ __('models/categories.fields.status') }}</b></th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            <b>{{ __('models/categories.fields.parent_id') }}</b></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $ob)
                        <tr>
                            <td>{{ $ob->id }}</td>

                            <td>{{ $ob->categor_name }}</td>
                            <td>{{ $ob->status }}</td>
                            <td>{{ $ob->parent_id }}</td>

                        </tr>
                    @endforeach

                </tbody>


            </table>


        </div>
    </div>
</body>

</html>
