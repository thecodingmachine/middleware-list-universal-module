<?php

namespace TheCodingMachine;

class MiddlewareOrder
{

    const EXCEPTION_EARLY = 3050;
    const EXCEPTION = 3000;
    const EXCEPTION_LATE = 2950;
    const UTILITY_EARLY = 2050;
    const UTILITY = 2000;
    const UTILITY_LATE = 1950;
    const ROUTER_EARLY = 1050;
    const ROUTER = 1000;
    const ROUTER_LATE = 950;
    const PAGE_NOT_FOUND_EARLY = 50;
    const PAGE_NOT_FOUND = 0;
    const PAGE_NOT_FOUND_LATE = -50;
    const STRATIGILITY_EXCEPTION_EARLY = -950;
    const STRATIGILITY_EXCEPTION = -1000;
    const STRATIGILITY_EXCEPTION_LATE = -1050;
}
