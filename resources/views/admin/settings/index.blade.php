@extends('admin.layout.wrapper')

@section('title', 'Settings')

@section('main-content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Settings</h3>
    </div>

    <style>
        .settings-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border);
            padding-bottom: 10px;
        }
        .settings-tab {
            padding: 10px 20px;
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-secondary);
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .settings-tab.active {
            background: var(--primary);
            color: #000;
            border-color: var(--primary);
        }
        .settings-tab:hover:not(.active) {
            border-color: var(--primary);
            color: var(--primary);
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>

    <div class="settings-tabs">
        <button type="button" class="settings-tab active" onclick="openTab('site')">Site Settings</button>
        <button type="button" class="settings-tab" onclick="openTab('contact')">Contact Info</button>
        <button type="button" class="settings-tab" onclick="openTab('social')">Social Links</button>
        <button type="button" class="settings-tab" onclick="openTab('store')">Store Settings</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div id="site" class="tab-content active">
            <h4 style="color: var(--primary); margin-bottom: 20px;">Site Settings</h4>
            <div class="form-group">
                <label class="form-label">Site Name</label>
                <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'Royal Furniture' }}">
            </div>
            <div class="form-group">
                <label class="form-label">Site Logo</label>
                <input type="file" name="site_logo" class="form-control" accept="image/*">
                @if(!empty($settings['site_logo']))
                    <div class="image-preview">
                        <img src="{{ asset('uploads/' . $settings['site_logo']) }}" alt="Logo">
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">Site Favicon</label>
                <input type="file" name="site_favicon" class="form-control" accept="image/*">
                @if(!empty($settings['site_favicon']))
                    <div class="image-preview">
                        <img src="{{ asset('uploads/' . $settings['site_favicon']) }}" alt="Favicon">
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">Site Description</label>
                <textarea name="site_description" class="form-control">{{ $settings['site_description'] ?? '' }}</textarea>
            </div>
        </div>

        <div id="contact" class="tab-content">
            <h4 style="color: var(--primary); margin-bottom: 20px;">Contact Information</h4>
            <div class="form-group">
                <label class="form-label">Contact Email</label>
                <input type="email" name="contact_email" class="form-control" value="{{ $settings['contact_email'] ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">Contact Phone</label>
                <input type="text" name="contact_phone" class="form-control" value="{{ $settings['contact_phone'] ?? '' }}">
            </div>
            <div class="form-group">
                <label class="form-label">Contact Address</label>
                <textarea name="contact_address" class="form-control">{{ $settings['contact_address'] ?? '' }}</textarea>
            </div>
        </div>

        <div id="social" class="tab-content">
            <h4 style="color: var(--primary); margin-bottom: 20px;">Social Links</h4>
            <div class="form-group">
                <label class="form-label">Facebook</label>
                <input type="url" name="facebook" class="form-control" value="{{ $settings['facebook'] ?? '' }}" placeholder="https://facebook.com/">
            </div>
            <div class="form-group">
                <label class="form-label">Twitter</label>
                <input type="url" name="twitter" class="form-control" value="{{ $settings['twitter'] ?? '' }}" placeholder="https://twitter.com/">
            </div>
            <div class="form-group">
                <label class="form-label">Instagram</label>
                <input type="url" name="instagram" class="form-control" value="{{ $settings['instagram'] ?? '' }}" placeholder="https://instagram.com/">
            </div>
            <div class="form-group">
                <label class="form-label">YouTube</label>
                <input type="url" name="youtube" class="form-control" value="{{ $settings['youtube'] ?? '' }}" placeholder="https://youtube.com/">
            </div>
        </div>

        <div id="store" class="tab-content">
            <h4 style="color: var(--primary); margin-bottom: 20px;">Store Settings</h4>
            <div class="form-group">
                <label class="form-label">Currency</label>
                <select name="currency" class="form-control">
                    @foreach($currencyOptions as $currencyCode => $currencyLabel)
                        <option value="{{ $currencyCode }}" {{ ($settings['currency'] ?? 'USD') == $currencyCode ? 'selected' : '' }}>{!! $currencyLabel !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Shipping Cost</label>
                <input type="number" name="shipping_cost" class="form-control" step="0.01" value="{{ $settings['shipping_cost'] ?? 0 }}">
            </div>
            <div class="form-group">
                <label class="form-label">Tax Rate (%)</label>
                <input type="number" name="tax_rate" class="form-control" step="0.01" value="{{ $settings['tax_rate'] ?? 0 }}">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>

<script>
    function openTab(tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab-content");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
            tabcontent[i].classList.remove("active");
        }
        tablinks = document.getElementsByClassName("settings-tab");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        document.getElementById(tabName).style.display = "block";
        document.getElementById(tabName).classList.add("active");
        event.currentTarget.classList.add("active");
    }
</script>
@endsection
