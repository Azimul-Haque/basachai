<!DOCTYPE html>
<html>
<head>
	<title>Attendace</title>
	<style type="text/css">
		table {
		  border-collapse: collapse;
		}

		table, th, td {
		  border: 1px solid black;
		}
	</style>
</head>
<body>
	<center>
		<table width="40%">
			<thead>
				<tr>
					<th>S#</th>
					<th>IP</th>
					<th>Time</th>
				</tr>
			</thead>
			<tbody>
				@php
					$counter = 1;
				@endphp
				@if(!empty($visits))
					@foreach($visits as $visit)
					<tr>
						<td>{{ $counter++ }}</td>
						<td>{{ $visit->data }}</td>
						<td>{{ date('F d, Y, h:i A', strtotime($visit->created_at)) }}</td>
					</tr>
					@endforeach
				@endif
			</tbody>
		</table>
	</center>
</body>
</html>