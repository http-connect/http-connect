<?php

namespace HttpConnect\HttpConnect\Service\Traits;

trait ConventionalCalls
{
    use ActionCall;
    use AnonymousCall {
        ActionCall::callAction insteadof AnonymousCall;
        ActionCall::getValidator insteadof AnonymousCall;
        ActionCall::handleMetadataValidation insteadof AnonymousCall;
    }
    use KeyCall {
        ActionCall::callAction insteadof KeyCall;
        ActionCall::getValidator insteadof KeyCall;
        ActionCall::handleMetadataValidation insteadof KeyCall;
    }
}
