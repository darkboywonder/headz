<form method="post" action="{{ route('barbershops') }}">
    @csrf
    <div>
        <label for="name">name</label>
        <input type="text" name="name" value="{{ old('name') }}"/>
    </div>
    <div>
        <label for="address">address</label>
        <input type="text" name="address" value="{{ old('address') }}"/>
    </div>
    <div>
        <label for="phone">phone</label>
        <input type="text" name="phone" value="{{ old('phone') }}"/>
    </div>
    <div>
        <label for="hours">hours</label>
        <input type="text" name="hours"value="{{ old('hours') }}"/>
    </div>
    <div>
        <label for="url">url</label>
        <input type="text" name="url" value="{{ old('url') }}"/>
    </div>
    <div>
        <label for="city">city</label>
        <input type="text" name="city" value="{{ old('city') }}"/>
    </div>
    <div>
        <label for="state">state</label>
        <input type="text" name="state" value="{{ old('state') }}"/>
    </div>
    <div>
        <label for="zip">zip</label>
        <input type="text" name="zip" value="{{ old('zip') }}"/>
    </div>
    <div>
        <label for="latitude">latitude</label>
        <input type="text" name="latitude" value="{{ old('latitude') }}"/>
    </div>
    <div>
        <label for="longitude">longitude</label>
        <input type="text" name="longitude" value="{{ old('longitude') }}"/>
    </div>
    <button type="submit">submit</button>
</form>