<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <header>
        <img src="https://intranet.km-t.cl/assets/front_end/img/logo_splice_azul2.png" 
        style="float:left;margin-left:50px;margin-top:30px;width:140px;height: 50px!important;">

        <span style="float:right;margin-right: 390px;margin-top:30px!important;font-size: 18px;font-weight: bold;text-decoration: underline;">{{$title}}</span>
    </header>

    <main>
        <table  class="table table-sm table-striped" border="0" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th style="padding: 5px!important;;"> {{__('user_name')}} </th>
                    <th style="padding: 5px!important;;"> {{__('user_email')}} </th>
                    <th style="padding: 5px!important;;"> {{__('user_phone')}} </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>{{ $d->name }}</td>
                    <td>{{ $d->email }}</td>
                    <td>{{ $d->date_admission }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- <div class="page-break"></div>
        <h1>Page 2</h1> -->

    </main>

    <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $pdf->text(270, 800, "Página $PAGE_NUM de $PAGE_COUNT", $font, 10);
            ');
        }
    </script>
</body>
</html>

<style>
    .page-break {
        page-break-after: always;
    }
    @page {
        margin: 0cm 0cm;
        font-family: Arial;
    }
  
    table{
    	 font-family:"Helvetica Neue", Helvetica, Arial, sans-serif!important;
    	 font-size: 13px!important;
    }
    body {
        margin: 3cm 2cm 2cm;
        font-family:"Helvetica Neue", Helvetica, Arial, sans-serif!important;
    }
    header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 3cm;
        text-align: center;
        line-height: 30px;
    }
    footer {
        position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
        background-color: #2a0927;
        color: white;
        text-align: center;
        line-height: 35px;
    }

    table tr td{
    	padding :1px 3px!important;
    }
    .table {
	  width: 100%;
	  max-width: 100%;
	  margin-bottom: 1rem;
	}

	.table th,
	.table td {
	  padding: 0.75rem;
	  vertical-align: top;
	  border-top: 1px solid #eceeef;
	}

	.table thead th {
	  vertical-align: bottom;
	  border-bottom: 2px solid #eceeef;
	}

	.table tbody + tbody {
	  border-top: 2px solid #eceeef;
	}

	.table .table {
	  background-color: #fff;
	}

	.table-sm th,
	.table-sm td {
	  padding: 0.3rem;
	}

	.table-bordered {
	  border: 1px solid #eceeef;
	}

	.table-bordered th,
	.table-bordered td {
	  border: 1px solid #eceeef;
	}

	.table-bordered thead th,
	.table-bordered thead td {
	  border-bottom-width: 2px;
	}

	.table-striped tbody tr:nth-of-type(odd) {
	  background-color: rgba(0, 0, 0, 0.05);
	}

	.table-hover tbody tr:hover {
	  background-color: rgba(0, 0, 0, 0.075);
	}

	.table-active,
	.table-active > th,
	.table-active > td {
	  background-color: rgba(0, 0, 0, 0.075);
	}

	.table-hover .table-active:hover {
	  background-color: rgba(0, 0, 0, 0.075);
	}

	
	.text-center{
		text-align: center!important;
	}
</style>