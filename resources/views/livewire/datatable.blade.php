<div class="px-4 sm:px-6 lg:px-8">
	<div class="sm:flex sm:items-center">
		<div class="sm:flex-auto">
			<div>
				<div class="mt-1">
					<input wire:model.debounce="search" type="search"
					       class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:w-1/2 sm:text-sm border-gray-300 rounded-md"
					       placeholder="Search...">
				</div>
			</div>
		</div>
		<div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">

			<div class="flex items-center space-x-2">
				<div class="flex items-center space-x-2">
					<label for="location" class="whitespace-nowrap block text-sm font-medium text-gray-700">Per
						Page</label>
					<select wire:model="paginate"
					        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
						<option>10</option>
						<option>20</option>
						<option>50</option>
						<option>100</option>
					</select>
				</div>


				<button type="button"
				        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
					Add user
				</button>
			</div>
		</div>
	</div>


	<div class="mt-8 flex flex-col" x-data="{ checked: @entangle('checked') }">
		{{--		<span x-html="checked"></span>--}}
		<div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
			<div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
				<div class="relative overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
					<!-- Selected row actions, only show when rows are selected. -->
					<div x-show="checked.length"
					     class="absolute top-0 left-12 flex h-12 items-center space-x-3 bg-gray-50 sm:left-16"
					     style="display: none;">
						<button type="button"
						        class="inline-flex items-center rounded border border-gray-300 bg-white px-2.5 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">
							Bulk edit
						</button>
						<button @click="$wire.deleteChecked(checked);" type="button"
						        class="inline-flex items-center rounded border border-red-300 bg-white px-2.5 py-1.5 text-xs font-medium text-red-700 shadow-sm bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-30">
							Delete selected
						</button>
					</div>

					<table class="min-w-full table-fixed divide-y divide-gray-300">
						<thead class="bg-gray-50">
						<tr>
							<th scope="col" class="relative w-12 px-6 sm:w-16 sm:px-8">
								<input type="checkbox"
								       class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6">
							</th>
							@foreach($columns as $column)
								<th scope="col" class="px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
									{{ $column }}</th>
							@endforeach
							<th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
								<span class="sr-only">Edit</span>
							</th>
						</tr>
						</thead>
						<tbody class="divide-y divide-gray-200 bg-white">
						@foreach($this->records() as $record)
							<!-- Selected: "bg-gray-100" -->
							<tr :class="{ 'bg-indigo-100': checked.includes('{{ $record->id }}'), 'even:bg-gray-50': !checked.includes('{{ $record->id }}') }"
							    wire:key="{{ $record->id }}">
								<td class="relative w-12 px-6 sm:w-16 sm:px-8">
									<!-- Selected row marker, only show when row is selected. -->
									<div x-show="checked.includes('{{ $record->id }}')"
									     class="absolute inset-y-0 left-0 w-0.5 bg-indigo-600"
									     style="display: none;"></div>

									<input x-model="checked" type="checkbox" :value="{{ $record->id }}"
									       class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sm:left-6">
								</td>
								@foreach($columns as $column)
									<!-- Selected: "text-indigo-600", Not Selected: "text-gray-900" -->
									<td :class="{ 'text-indigo-600': checked.includes('{{ $record->id }}') }"
									    class="whitespace-nowrap py-2 pr-3 text-sm text-gray-900">{{ $record->$column }}</td>
								@endforeach
								<td class="whitespace-nowrap py-2 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
									<a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
								</td>
							</tr>
						@endforeach

						</tbody>
					</table>
				</div>

				<div class="mt-8">
					{{ $this->records()->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
