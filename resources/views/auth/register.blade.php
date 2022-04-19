@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" name="gender" class="form-control">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

                            <div class="col-md-6">
                                <input id="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" required>

                                @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationality" class="col-md-4 col-form-label text-md-right">{{ __('Nationality') }}</label>

                            <div class="col-md-6">
                                <select id="nationality" name="nationality" class="form-control">
                                    <option value="syrian">Syrian</option>
                                    <option value="afghan">Afghan</option>
                                Algerian
                                Albanian
                                American
                                Andorran
                               Angolan
                                 Antiguans
                                   Argentinean
                                Armenian
                                  Australian
                                Austrian
                                   Azerbaijani
                                Bahamian
                                Bahraini
                                   Bangladeshi
                                 Barbadian
                                 Barbudans
                                Batswana
                                  Belarusian
                               Belgian
                                Belizean
                                Beninese
                                 Bhutanese
                                Bolivian
                               Bosnian
                                 Brazilian
                               British
                                Bruneian
                                 Bulgarian
                                 Burkinabe
                               Burmese
                                 Burundian
                                 Cambodian
                                   Cameroonian
                                Canadian
                               Chadian
                               Chilean
                               Chinese
                                 Colombian
                               Comoran
                                 Congolese
                                   Costa Rican
                                Croatian
                             Cuban
                               Cypriot
                             Czech
                              Danish
                                Djibouti
                                 Dominican
                            Dutch
                                    <option value="east timorese">East Timorese</option>
                                    <option value="ecuadorean">Ecuadorean</option>
                                    <option value="egyptian">Egyptian</option>
                                    <option value="emirian">Emirian</option>
                                    <option value="equatorial guinean">Equatorial Guinean</option>
                                    <option value="eritrean">Eritrean</option>
                                    <option value="estonian">Estonian</option>
                                    <option value="ethiopian">Ethiopian</option>
                                    <option value="fijian">Fijian</option>
                                    <option value="filipino">Filipino</option>
                                    <option value="finnish">Finnish</option>
                                    <option value="french">French</option>
                                    <option value="gabonese">Gabonese</option>
                                    <option value="gambian">Gambian</option>
                                    <option value="georgian">Georgian</option>
                                    <option value="german">German</option>
                                    <option value="ghanaian">Ghanaian</option>
                                    <option value="greek">Greek</option>
                                    <option value="grenadian">Grenadian</option>
                                    <option value="guatemalan">Guatemalan</option>
                                    <option value="guinea-bissauan">Guinea-Bissauan</option>
                                    <option value="guinean">Guinean</option>
                                    <option value="guyanese">Guyanese</option>
                                    <option value="haitian">Haitian</option>
                                    <option value="herzegovinian">Herzegovinian</option>
                                    <option value="honduran">Honduran</option>
                                    <option value="hungarian">Hungarian</option>
                                    <option value="icelander">Icelander</option>
                                    <option value="indian">Indian</option>
                                    <option value="indonesian">Indonesian</option>
                                    <option value="iranian">Iranian</option>
                                    <option value="iraqi">Iraqi</option>
                                    <option value="irish">Irish</option>
                                    <option value="israeli">Israeli</option>
                                    <option value="italian">Italian</option>
                                    <option value="ivorian">Ivorian</option>
                                    <option value="jamaican">Jamaican</option>
                                    <option value="japanese">Japanese</option>
                                    <option value="jordanian">Jordanian</option>
                                    <option value="kazakhstani">Kazakhstani</option>
                                    <option value="kenyan">Kenyan</option>
                                    <option value="kittian and nevisian">Kittian and Nevisian</option>
                                    <option value="kuwaiti">Kuwaiti</option>
                                    <option value="kyrgyz">Kyrgyz</option>
                                    <option value="laotian">Laotian</option>
                                    <option value="latvian">Latvian</option>
                                    <option value="lebanese">Lebanese</option>
                                    <option value="liberian">Liberian</option>
                                    <option value="libyan">Libyan</option>
                                    <option value="liechtensteiner">Liechtensteiner</option>
                                    <option value="lithuanian">Lithuanian</option>
                                    <option value="luxembourger">Luxembourger</option>
                                    <option value="macedonian">Macedonian</option>
                                    <option value="malagasy">Malagasy</option>
                                    <option value="malawian">Malawian</option>
                                    <option value="malaysian">Malaysian</option>
                                    <option value="maldivan">Maldivan</option>
                                    <option value="malian">Malian</option>
                                    <option value="maltese">Maltese</option>
                                    <option value="marshallese">Marshallese</option>
                                    <option value="mauritanian">Mauritanian</option>
                                    <option value="mauritian">Mauritian</option>
                                    <option value="mexican">Mexican</option>
                                    <option value="micronesian">Micronesian</option>
                                    <option value="moldovan">Moldovan</option>
                                    <option value="monacan">Monacan</option>
                                    <option value="mongolian">Mongolian</option>
                                    <option value="moroccan">Moroccan</option>
                                    <option value="mosotho">Mosotho</option>
                                    <option value="motswana">Motswana</option>
                                    <option value="mozambican">Mozambican</option>
                                    <option value="namibian">Namibian</option>
                                    <option value="nauruan">Nauruan</option>
                                    <option value="nepalese">Nepalese</option>
                                    <option value="new zealander">New Zealander</option>
                                    <option value="ni-vanuatu">Ni-Vanuatu</option>
                                    <option value="nicaraguan">Nicaraguan</option>
                                    <option value="nigerien">Nigerien</option>
                                    <option value="north korean">North Korean</option>
                                    <option value="northern irish">Northern Irish</option>
                                    <option value="norwegian">Norwegian</option>
                                    <option value="omani">Omani</option>
                                    <option value="pakistani">Pakistani</option>
                                    <option value="palauan">Palauan</option>
                                    <option value="panamanian">Panamanian</option>
                                    <option value="papua new guinean">Papua New Guinean</option>
                                    <option value="paraguayan">Paraguayan</option>
                                    <option value="peruvian">Peruvian</option>
                                    <option value="polish">Polish</option>
                                    <option value="portuguese">Portuguese</option>
                                    <option value="qatari">Qatari</option>
                                    <option value="romanian">Romanian</option>
                                    <option value="russian">Russian</option>
                                    <option value="rwandan">Rwandan</option>
                                    <option value="saint lucian">Saint Lucian</option>
                                    <option value="salvadoran">Salvadoran</option>
                                    <option value="samoan">Samoan</option>
                                    <option value="san marinese">San Marinese</option>
                                    <option value="sao tomean">Sao Tomean</option>
                                    <option value="saudi">Saudi</option>
                                    <option value="scottish">Scottish</option>
                                    <option value="senegalese">Senegalese</option>
                                    <option value="serbian">Serbian</option>
                                    <option value="seychellois">Seychellois</option>
                                    <option value="sierra leonean">Sierra Leonean</option>
                                    <option value="singaporean">Singaporean</option>
                                    <option value="slovakian">Slovakian</option>
                                    <option value="slovenian">Slovenian</option>
                                    <option value="solomon islander">Solomon Islander</option>
                                    <option value="somali">Somali</option>
                                    <option value="south african">South African</option>
                                    <option value="south korean">South Korean</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="sri lankan">Sri Lankan</option>
                                    <option value="sudanese">Sudanese</option>
                                    <option value="surinamer">Surinamer</option>
                                    <option value="swazi">Swazi</option>
                                    <option value="swedish">Swedish</option>
                                    <option value="swiss">Swiss</option>
                                    <option value="taiwanese">Taiwanese</option>
                                    <option value="tajik">Tajik</option>
                                    <option value="tanzanian">Tanzanian</option>
                                    <option value="thai">Thai</option>
                                    <option value="togolese">Togolese</option>
                                    <option value="tongan">Tongan</option>
                                    <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                                    <option value="tunisian">Tunisian</option>
                                    <option value="turkish">Turkish</option>
                                    <option value="tuvaluan">Tuvaluan</option>
                                    <option value="ugandan">Ugandan</option>
                                    <option value="ukrainian">Ukrainian</option>
                                    <option value="uruguayan">Uruguayan</option>
                                    <option value="uzbekistani">Uzbekistani</option>
                                    <option value="venezuelan">Venezuelan</option>
                                    <option value="vietnamese">Vietnamese</option>
                                    <option value="welsh">Welsh</option>
                                    <option value="yemenite">Yemenite</option>
                                    <option value="zambian">Zambian</option>
                                    <option value="zimbabwean">Zimbabwean</option>
                                </select>
                                @error('nationality')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">{{ __('Bio') }}</label>

                            <div class="col-md-6">
                                <input id="bio" type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" value="{{ old('bio') }}" required autocomplete="bio" autofocus>

                                @error('bio')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
