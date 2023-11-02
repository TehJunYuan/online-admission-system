<?php

    /**
     * Constants File
     *
     * This file stores various constant values used throughout the application.
     * Constants provide a centralized location for storing fixed values that are
     * reused across multiple files. By defining constants here, it becomes easier
     * to manage and update them when needed, ensuring consistency and reducing
     * the risk of errors caused by hard-coded values.
     *
     * Modify the values in this file carefully as they may affect the behavior of
     * the entire application. It is recommended to consult the documentation or
     * seek guidance from the development team before making any changes.
     */

    return [

    /**
     * Status Constants
     *
     * These constants define the boolean values used to represent status in the application.
     * A status of 1 signifies an active or enabled state, while a status of 0 signifies
     * an inactive or disabled state. These constants provide a clear and standardized
     * representation of status values throughout the codebase, enhancing code readability
     * and maintainability.
     *
     * Example usage:
     * - `STATUS_ACTIVE` can be used to check if a user account is active.
     * - `STATUS_INACTIVE` can be used to determine if a feature or functionality is disabled.
     *
     * Important: Modifying the values of these constants should be done with caution, as it
     * can affect the behavior of the entire application. Consult the documentation or consult
     * with the development team before making any changes to ensure proper functionality.
     */

    'STATUS' => [
        'STATUS_ACTIVE' => 1,
        'STATUS_INACTIVE' => 0,
    ],

    /**
     * Data Stored Status Constants
     *
     * These constants define the status values used to represent the outcome of data storage operations.
     * The constant values provide a standardized representation for success and failure, enhancing code
     * readability and maintainability.
     *
     * Example usage:
     * - `DATA_STORED_SUCCESSFULLY` can be used to indicate that the data was stored successfully.
     * - `DATA_STORE_FAILED` can be used to indicate that the data storage operation failed.
     *
     * Important: These constants should be used consistently throughout the codebase to maintain a
     * clear and uniform representation of data storage statuses.
     */

    'DATA_STORED_STATUS' => [
        'DATA_STORED_SUCCESSFULLY' => 'The data is stored successfully.',
    ],

    /**
     * Address Types
     * 
     * CORRESPONDENCE represents the correspondence address type with a value of 1
     * PERMANENT represents the permanent address type with a value of 2
     */
    'ADDRESS_TYPE' => [
        'CORRESPONDENCE' => 1,
        'PERMANENT' => 2,
    ],
    /*
    |-----------------------------------------------------------
    | choice priority 
    |-----------------------------------------------------------
    */
    'CHOICE_PRIORITY' => [
        'FIRST_CHOICE' => 1,
        'SECOND_CHOICE' => 2,
        'THIRD_CHOICE' => 3,
    ],

    'APPLICANT_PROFILE_STATUS_CODE' => [
        'COMPLETE_PERSONAL_PARTICULARS' => 1,
        'COMPLETE_PARENT_GUARDIAN_PARTICULARS' => 2,
        'COMPLETE_EMERGENCY_CONTACT' => 3,
        'COMPLETE_PROFILE_PICTURE' => 4,
    ],

    'APPLICATION_STATUS_CODE' => [
        'COMPLETE_PROGRAM_SELECTION' => 1,
        'COMPLETE_ACADEMIC_DETAIL' => 2,
        'COMPLETE_STATUS_OF_HEALTH' => 3,
        'COMPLETE_AGREEMENT' => 4,
        'COMPLETE_DRAFT' => 5,
        'COMPLETE_SUPPORTING_DOCUEMENT' => 6,
        'COMPLETE_PAYMENT' => 7,
    ],

    'PROFILE_PICTURE' => [
        'WIDTH' => 210,
        'HEIGHT' => 280,
        'MAXSIZE_KB' => 5120,
    ],

    'SCHOOL_LEVEL' => [
        'SECONDARY' => 1,
        'UPPERSECONDARY' => 2,
        'FOUNDATION' => 3,
        'DIPLOMA' => 4,
        'DEGREE' => 5,
        'MASTER' =>6,
        'PHD' => 7,
        'OTHER' => 8,
    ],

    'IS_CERT' => [
        'FALSE' => 0,
        'TRUE' => 1,
    ],

    'IDENTITY_DOCUEMENT_TYPE' => [
        'IC_FRONT' => 1,
        'IC_BACK' => 2,
    ],

    'CANDIDATE_PROFILE_STATUS' => [
        'COMPLETE_SUBMIT_PAYMENT' => 1,
        'COMPLETE_CHECKING_PAYMENT_SLIP' => 2,
        'PAYMENT_SLIP_REJECTED_BY_AFO' => 3,
        'COMPLETE_CHECKING_APPLICATION' => 4,
        'APPLICATION_REJECTED_BY_SRO' => 5,
        'APPROVE_BECOME_STUDENT' => 6,
        'APPLICATION_REJECTED_BY_AARO' => 7,
        'COMPLETE_OFFER_LETTER' => 8,
    ],
];
