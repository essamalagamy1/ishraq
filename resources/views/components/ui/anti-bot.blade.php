@php
    $spamService = app(\App\Services\SpamProtectionService::class);
    $formToken = $spamService->generateToken();
    $expectedJsToken = $spamService->getJsExpectedToken();
    $uniqueId = 'hp_' . bin2hex(random_bytes(4));
@endphp

{{-- Hidden Honeypot Trap for automated crawlers/bots --}}
<div style="position: absolute !important; left: -9999px !important; top: -9999px !important; width: 1px !important; height: 1px !important; opacity: 0 !important; pointer-events: none !important; overflow: hidden !important; z-index: -1 !important;" aria-hidden="true" tabindex="-1">
    <label for="{{ $uniqueId }}_website">Website</label>
    <input type="text" name="_hp_website" id="{{ $uniqueId }}_website" value="" tabindex="-1" autocomplete="new-password" />
    
    <label for="{{ $uniqueId }}_company">Company</label>
    <input type="text" name="_hp_company" id="{{ $uniqueId }}_company" value="" tabindex="-1" autocomplete="new-password" />

    <label for="{{ $uniqueId }}_fax">Fax Number</label>
    <input type="text" name="_hp_fax_check" id="{{ $uniqueId }}_fax" value="" tabindex="-1" autocomplete="new-password" />
</div>

{{-- Timestamp & Integrity Token --}}
<input type="hidden" name="_form_submission_token" value="{{ $formToken }}" />

{{-- JavaScript Human Interaction Token --}}
<input type="hidden" name="_js_interaction_token" class="js-antispam-token" value="" />

<script>
    (function() {
        var tokenVal = '{{ $expectedJsToken }}';
        function activateHumanToken() {
            var inputs = document.querySelectorAll('.js-antispam-token');
            inputs.forEach(function(input) {
                if (input && !input.value) {
                    input.value = tokenVal;
                }
            });
        }
        
        ['mousedown', 'keydown', 'touchstart', 'focusin', 'input'].forEach(function(evtName) {
            window.addEventListener(evtName, activateHumanToken, { once: true, passive: true });
        });

        // Also ensure it is populated immediately if form submit is triggered
        document.addEventListener('submit', function(e) {
            activateHumanToken();
        }, true);
    })();
</script>
