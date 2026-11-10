<section class="section-shell" id="contact">
    <div class="container" style="max-width:760px">
        <h2>Send a message</h2>
        <p>Have a birthday message or question? Leave a note below.
            @if(!empty($siteSettings['contact_email'] ?? null))
                You can also email
                <a href="mailto:{{ $siteSettings['contact_email'] }}">{{ $siteSettings['contact_email'] }}</a>.
            @endif
        </p>

        @if(session('inquiry_status'))
            <div class="alert alert-success">{{ session('inquiry_status') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('inquiries.store') }}">
            @csrf
            <div style="position:absolute;left:-10000px" aria-hidden="true">
                <label>Website<input name="website" tabindex="-1" autocomplete="off"></label>
            </div>
            <label for="inq-name">Your name</label>
            <input id="inq-name" class="form-control mb-3" name="name" maxlength="120" required value="{{ old('name') }}">
            <label for="inq-email">Email</label>
            <input id="inq-email" class="form-control mb-3" type="email" name="email" maxlength="180" required value="{{ old('email') }}">
            <label for="inq-subject">Subject</label>
            <input id="inq-subject" class="form-control mb-3" name="subject" maxlength="180" value="{{ old('subject') }}">
            <label for="inq-message">Message</label>
            <textarea id="inq-message" class="form-control mb-3" name="message" rows="5" maxlength="5000" required>{{ old('message') }}</textarea>
            <button class="btn btn-dark" type="submit">Send message</button>
        </form>
    </div>
</section>
