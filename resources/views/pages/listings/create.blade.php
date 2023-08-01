<x-layout>
    <div class="container">
        <h1>Create new job listing $(49)</h1>

        <x-form
            id="listing__form"
            action="{{ route('listings.store') }}"
            enctype="multipart/form-data"
            method="POST"
        >
            @csrf

            @if($errors->any())
                {!! implode('', $errors->all('<div>:message</div>')) !!}
            @endif


            @guest()
                <div class="form__card">
                    <h2>User Information</h2>

                    <x-form.group class="form__group--dark" name="name"/>

                    <x-form.group class="form__group--dark" name="email" type="email"/>

                    <x-form.group class="form__group--dark" name="password" type="password"/>

                    <x-form.group class="form__group--dark" name="password_confirmation" label="Password Confirmation"
                                  type="password"/>
                </div>
            @endguest

            <x-form.group name="title" label="Job Title" type="text"/>

            <x-form.group name="location">
                <x-form.label for="location">Job Location</x-form.label>
                <x-form.input name="location" id="location" :value="old('location')"/>
                <span>Example: "Remote, Anywhere", "Remote, USA Only"</span>
            </x-form.group>

            <x-form.group name="company" label="Company Name" type="text"/>

            <x-form.group name="salary" type="number"/>

            <x-form.group name="contract_type">
                <x-form.label for="contract_type">Type</x-form.label>

                <x-form.select name="contract_type" id="contract_type">
                    <option value="full-time">Full-Time</option>
                    <option value="part-time">Part-Time</option>
                </x-form.select>
            </x-form.group>

            <x-form.group name="tags">
                <x-form.label for="tags">Tags (Separated by commas)</x-form.label>
                <x-form.input name="tags" id="tags" :value="old('tags')"/>
                <span>Example: "php, javascript, react, html"</span>
            </x-form.group>

            <x-form.group name="apply_link">
                <x-form.label for="apply_link">Application Link</x-form.label>
                <x-form.input name="apply_link" id="apply_link" :value="old('apply_link')"/>
                <span>Example: "https://yourcompany.com/careers"</span>
            </x-form.group>

            <x-form.group name="logo" type="file"/>

            <x-form.group name="content">
                <x-form.label for="content">Content</x-form.label>
                <x-form.textarea name="content" id="content" rows="10" :value="old('content')"></x-form.textarea>
            </x-form.group>

            <div id="card-element"></div>

            <x-form.input type="hidden" name="payment_method_id" id="payment_method_id" value=""/>

            <div class="form__button-container">
                <button class="button" id="form_submit">Create</button>
            </div>
        </x-form>
    </div>
</x-layout>

<script src="https://js.stripe.com/v3/"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');
        const elements = stripe.elements();
        const cardElement = elements.create('card', {
            'classes': {
                'base': 'StripeElement form__input form__card-element'
            }
        });

        cardElement.mount('#card-element');

        document.getElementById('form_submit').addEventListener('click', async (e) => {
            e.preventDefault();

            const { paymentMethod, error } = await stripe.createPaymentMethod('card', cardElement, {});

            if (error) {
                alert(error.message);
            } else {
                document.getElementById('payment_method_id').value = paymentMethod.id;
                document.getElementById('listing__form').submit();
            }
        });
    })
</script>

