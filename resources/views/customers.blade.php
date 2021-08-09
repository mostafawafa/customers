<html lang="en">
<head>
    <style>
        th, td, table {
            text-align: center;
        }

        table,form{
            width: 100%;
        }

        table,th,tr,td {
            border: 1px solid rgba(59, 54, 54, 0.18);
        }

        body{
            background: #36566f;
            color: #ffffff;
            text-align: center;

        }

        form {
            display: inline-block;
        }

    </style>

    <title>customers</title>
</head>
<body>

<h1>Phone numbers</h1>
    <form action="/customers" method="get">

        <label for="phoneCountry">Country:</label>
        <select name="phoneCountry" id="country">
            <option value="">any country</option>

            @foreach($countries as $country)
                @if($country == $selectedCountry):
                    <option selected value="{{$country}}">{{$country}}</option>
                @else:
                    <option value="{{$country}}">{{$country}}</option>

                @endif
            @endforeach

        </select>

        <label for="isValidPhone">Phone state:</label>
        <select name="isValidPhone" id="isValidPhone">
            <option  value="" >any state</option>
            <option @if(!empty($isValid) && $isValid == 1): selected @endif  value="1">valid</option>
            <option @if($isValid === "0"): selected @endif  value="0">Not valid</option>
        </select>
        <input type="submit" value="click to filter">


    </form>
<table >

    <tr>
        <th>Country</th>
        <th>State</th>
        <th>Country code</th>
        <th>phone num</th>

    </tr>
    @foreach ($customers as $user)
        <tr>
            <td>{{$user['country']}}</td>
            <td>
                @if ($user['isValidPhone'])
                    ok
                @else
                    nok
                @endif

            </td>
            <td>{{$user['code']}}</td>
            <td>{{$user['phone']}}</td>

        </tr>
    @endforeach


</table>

</body>

</html>
