<div>
    <select wire:model="county">
        <option value="Any">Any </option>
        @foreach ($counties AS $county)
            <option value="{{ $county->provider_campus_county }}"> {{ ucfirst($county->provider_campus_county)  }} </option>
        @endforeach
    </select>

    <select wire:model="city">
        <option value="Any">Any </option>
        @foreach ($cities AS $city)
            <option value="{{ $city->provider_campus_city }}"> {{ ucfirst($city->provider_campus_city)  }} </option>
        @endforeach
    </select>

</div>
