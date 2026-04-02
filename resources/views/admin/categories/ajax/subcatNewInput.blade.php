 <tbody>
	<tr>

		<td width="120">
			New Subcategory: 
		</td>

	<td>
		<form action="{{ route('admin.subcatAddNew', $cat) }}" class="subcat_add_new" data-url="" method="POST">
			@foreach (editions() as $lan)
			<b>{{ $lan }}: </b><input type="text" class="input-sm input-subcat-new" name="{{ $lan }}_subcat" data-url="{{ route('admin.subcatAddNew', $cat) }}" placeholder="New Subcategory Name">
			@endforeach
				
				
				<button type="submit" class="btn btn-primary btn-sm btn-subcat-submit">Submit New Subcategory</button>
		</form>

					
	</td>

	</tr>
</tbody>