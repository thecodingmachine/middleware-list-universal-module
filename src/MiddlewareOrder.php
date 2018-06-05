<?php

namespace TheCodingMachine;

class MiddlewareOrder
{
    const EXCEPTION_EARLY = 3050.0;
    const EXCEPTION = 3000.0;
    const EXCEPTION_LATE = 2950.0;
    const UTILITY_EARLY = 2050.0;
    const UTILITY = 2000.0;
    const UTILITY_LATE = 1950.0;
    const ROUTER_EARLY = 1050.0;
    const ROUTER = 1000.0;
    const ROUTER_LATE = 950.0;
    const PAGE_NOT_FOUND_EARLY = 50.0;
    const PAGE_NOT_FOUND = 0.0;
    const PAGE_NOT_FOUND_LATE = -50.0;
}
