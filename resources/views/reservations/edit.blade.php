@extends('layouts.main')

@section('content')
  <main class="flex-1 bg-white">
    <div class="px-12 py-10">
      <div class="flex items-center gap-4">
        <a href="{{ route('reservations.index') }}" class="text-gray-400 hover:text-gray-600">
          <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 0 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z" clip-rule="evenodd" />
          </svg>
        </a>
        <h1 class="text-2xl font-semibold text-gray-900">Edit Booking</h1>
      </div>
      <div class="mt-6 h-px w-full bg-gray-100"></div>

      <form action="{{ route('reservations.update', $reservation) }}" method="POST" class="mt-8 max-w-2xl space-y-8">
        @csrf
        @method('PUT')

        {{-- Client & Agency --}}
        <div class="space-y-6">
          <h2 class="text-lg font-medium text-gray-900">Client & Agency</h2>

          <div class="grid grid-cols-2 gap-6">
            <div>
              <label for="client_id" class="block text-sm font-medium text-gray-700">Client <span class="text-red-500">*</span></label>
              <div class="mt-2">
                <select name="client_id" id="client_id" required
                  class="block w-full rounded-lg border @error('client_id') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100">
                  <option value="">Select client</option>
                  @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id', $reservation->client_id) == $client->id ? 'selected' : '' }}>{{ $client->company_name }}</option>
                  @endforeach
                </select>
              </div>
              @error('client_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="agency_id" class="block text-sm font-medium text-gray-700">Agency</label>
              <div class="mt-2">
                <select name="agency_id" id="agency_id"
                  class="block w-full rounded-lg border @error('agency_id') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100">
                  <option value="">Select agency</option>
                  @foreach($agencies as $agency)
                    <option value="{{ $agency->id }}" {{ old('agency_id', $reservation->agency_id) == $agency->id ? 'selected' : '' }}>{{ $agency->company_name }}</option>
                  @endforeach
                </select>
              </div>
              @error('agency_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div>
            <label for="salesperson_id" class="block text-sm font-medium text-gray-700">Salesperson</label>
            <div class="mt-2">
              <select name="salesperson_id" id="salesperson_id"
                class="block w-full rounded-lg border @error('salesperson_id') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100">
                <option value="">Select salesperson</option>
                @foreach($salespeople as $salesperson)
                  <option value="{{ $salesperson->id }}" {{ old('salesperson_id', $reservation->salesperson_id) == $salesperson->id ? 'selected' : '' }}>{{ $salesperson->first_name }} {{ $salesperson->last_name }}</option>
                @endforeach
              </select>
            </div>
            @error('salesperson_id')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>

        {{-- Product Details --}}
        <div class="space-y-6">
          <h2 class="text-lg font-medium text-gray-900">Product Details</h2>

          <div>
            <label for="product" class="block text-sm font-medium text-gray-700">Product <span class="text-red-500">*</span></label>
            <div class="mt-2">
              <input type="text" name="product" id="product" value="{{ old('product', $reservation->product) }}" required
                class="block w-full rounded-lg border @error('product') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100" />
            </div>
            @error('product')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>

          <div class="grid grid-cols-2 gap-6">
            <div>
              <label for="placement_id" class="block text-sm font-medium text-gray-700">Placement <span class="text-red-500">*</span></label>
              <div class="mt-2">
                <select name="placement_id" id="placement_id" required
                  class="block w-full rounded-lg border @error('placement_id') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100">
                  <option value="">Select placement</option>
                  @foreach($placements as $placement)
                    <option value="{{ $placement->id }}" {{ old('placement_id', $reservation->placement_id) == $placement->id ? 'selected' : '' }}>{{ $placement->name }}</option>
                  @endforeach
                </select>
              </div>
              @error('placement_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="channel" class="block text-sm font-medium text-gray-700">Channel <span class="text-red-500">*</span></label>
              <div class="mt-2">
                <select name="channel" id="channel" required
                  class="block w-full rounded-lg border @error('channel') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100">
                  <option value="">Select channel</option>
                  @foreach($channels as $channel)
                    <option value="{{ $channel }}" {{ old('channel', $reservation->channel) === $channel ? 'selected' : '' }}>{{ $channel }}</option>
                  @endforeach
                </select>
              </div>
              @error('channel')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div>
            <label for="scope" class="block text-sm font-medium text-gray-700">Scope <span class="text-red-500">*</span></label>
            <div class="mt-2">
              <select name="scope" id="scope" required
                class="block w-full rounded-lg border @error('scope') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100">
                <option value="">Select scope</option>
                @foreach($scopes as $scope)
                  <option value="{{ $scope }}" {{ old('scope', $reservation->scope) === $scope ? 'selected' : '' }}>{{ $scope }}</option>
                @endforeach
              </select>
            </div>
            @error('scope')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>

        {{-- Dates --}}
        <div class="space-y-6">
          <h2 class="text-lg font-medium text-gray-900">Booking Dates</h2>

          <div x-data="datePicker()" x-init="init()">
            <label for="dates_display" class="block text-sm font-medium text-gray-700">Dates Booked <span class="text-red-500">*</span></label>
            <div class="mt-2">
              <input type="text" id="dates_display" x-ref="datepicker" readonly
                class="block w-full rounded-lg border @error('dates_booked') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100 cursor-pointer"
                placeholder="Click to select dates" />
              <input type="hidden" name="dates_booked" x-model="datesJson" />
            </div>
            <p class="mt-1 text-xs text-gray-500">Click on individual dates to select them. You can select multiple non-consecutive dates.</p>
            @error('dates_booked')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>

        {{-- Financials --}}
        <div class="space-y-6">
          <h2 class="text-lg font-medium text-gray-900">Financials</h2>

          <div class="grid grid-cols-2 gap-6">
            <div>
              <label for="amount" class="block text-sm font-medium text-gray-700">Amount (MUR) <span class="text-red-500">*</span></label>
              <div class="mt-2">
                <input name="amount" id="amount" value="{{ old('amount', $reservation->amount) }}" required
                  class="block w-full rounded-lg border @error('amount') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100" />
              </div>
              @error('amount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="discount" class="block text-sm font-medium text-gray-700">Discount (MUR)</label>
              <div class="mt-2">
                <input name="discount" id="discount" value="{{ old('discount', $reservation->discount) }}"
                  class="block w-full rounded-lg border @error('discount') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100" />
              </div>
              @error('discount')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="grid grid-cols-2 gap-6">
            <div>
              <label for="commission" class="block text-sm font-medium text-gray-700">Commission (MUR)</label>
              <div class="mt-2">
                <input name="commission" id="commission" value="{{ old('commission', $reservation->commission) }}"
                  class="block w-full rounded-lg border @error('commission') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100" />
              </div>
              @error('commission')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="cost_of_artwork" class="block text-sm font-medium text-gray-700">Cost of Artwork (MUR)</label>
              <div class="mt-2">
                <input name="cost_of_artwork" id="cost_of_artwork" value="{{ old('cost_of_artwork', $reservation->cost_of_artwork) }}"
                  class="block w-full rounded-lg border @error('cost_of_artwork') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100" />
              </div>
              @error('cost_of_artwork')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="grid grid-cols-2 gap-6">
            <div>
              <label for="vat" class="block text-sm font-medium text-gray-700">VAT (MUR)</label>
              <div class="mt-2">
                <input name="vat" id="vat" value="{{ old('vat', $reservation->vat) }}"
                  class="block w-full rounded-lg border @error('vat') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100" />
              </div>
              @error('vat')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div class="flex items-end pb-1">
              <label class="inline-flex items-center gap-2 text-sm text-gray-700">
                <input type="hidden" name="vat_exempt" value="0" />
                <input type="checkbox" name="vat_exempt" value="1" {{ old('vat_exempt', $reservation->vat_exempt) ? 'checked' : '' }}
                  class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-200" />
                VAT Exempt
              </label>
            </div>
          </div>
        </div>

        {{-- Reference Numbers --}}
        <div class="space-y-6">
          <h2 class="text-lg font-medium text-gray-900">Reference Numbers</h2>

          <div class="grid grid-cols-2 gap-6">
            <div>
              <label for="purchase_order_no" class="block text-sm font-medium text-gray-700">Purchase Order No.</label>
              <div class="mt-2">
                <input type="text" name="purchase_order_no" id="purchase_order_no" value="{{ old('purchase_order_no', $reservation->purchase_order_no) }}"
                  class="block w-full rounded-lg border @error('purchase_order_no') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100" />
              </div>
              @error('purchase_order_no')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="invoice_no" class="block text-sm font-medium text-gray-700">Invoice No.</label>
              <div class="mt-2">
                <input type="text" name="invoice_no" id="invoice_no" value="{{ old('invoice_no', $reservation->invoice_no) }}"
                  class="block w-full rounded-lg border @error('invoice_no') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100" />
              </div>
              @error('invoice_no')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        {{-- Remark --}}
        <div class="space-y-6">
          <h2 class="text-lg font-medium text-gray-900">Additional Information</h2>

          <div>
            <label for="remark" class="block text-sm font-medium text-gray-700">Remark</label>
            <div class="mt-2">
              <textarea name="remark" id="remark" rows="4"
                class="block w-full rounded-lg border @error('remark') border-red-500 @else border-gray-200 @enderror bg-white px-4 py-2.5 text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-gray-300 focus:outline-none focus:ring-4 focus:ring-gray-100">{{ old('remark', $reservation->remark) }}</textarea>
            </div>
            @error('remark')
              <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div class="flex items-center gap-4">
          <button type="submit" class="rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-200">
            Update Booking
          </button>
          <a href="{{ route('reservations.index') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900">
            Cancel
          </a>
        </div>
      </form>
    </div>
  </main>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script>
    function datePicker() {
      return {
        dates: [],
        datesJson: '[]',
        init() {
          const existingDates = @json($reservation->dates_booked);
          const oldDates = @json(old('dates_booked') ? json_decode(old('dates_booked')) : null);
          this.dates = oldDates || existingDates || [];
          this.datesJson = JSON.stringify(this.dates);

          flatpickr(this.$refs.datepicker, {
            mode: 'multiple',
            dateFormat: 'Y-m-d',
            defaultDate: this.dates,
            onChange: (selectedDates, dateStr) => {
              this.dates = selectedDates.map(date => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
              });
              this.datesJson = JSON.stringify(this.dates);
            }
          });
        }
      }
    }
  </script>
@endsection
