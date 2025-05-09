// commitlint configuration file to enforce commit message conventions
module.exports = {
    // Extends the conventional commit rules to ensure standardized commit messages
    extends: ["@commitlint/config-conventional"],
    rules: {
        // Enforces specific types for commit messages to maintain consistency and clarity
        "type-enum": [
            2, // Sets the rule to be an error if violated
            "always", // Ensures the rule is always applied
            [
                "feat", // Allows feature-related commits for tracking new functionalities
                "fix", // Allows bug fix commits for tracking resolved issues
                "docs", // Allows documentation-related commits for better project understanding
                "style", // Allows style-related commits for non-functional code changes
                "refactor", // Allows refactoring commits for code improvements without changing behavior
                "test", // Allows test-related commits for tracking test additions or updates
                "chore", // Allows chore-related commits for maintenance tasks
                "ci", // Allows CI-related commits for tracking continuous integration changes
                "build", // Allows build-related commits for tracking build system changes
                "revert", // Allows revert commits for tracking reverted changes
            ],
        ],
        // Enforces specific scopes for commit messages to maintain clarity and organization
        "scope-enum": [
            2, // Sets the rule to be an error if violated
            "always", // Ensures the rule is always applied
            [
                "animations", // Allows commits related to animations
                "api", // Allows commits related to API changes
                "auth", // Allows commits related to authentication
                "changelog", // Allows commits related to changelog updates
                "common", // Allows commits related to common/shared code
                "config", // Allows commits related to configuration changes
                "core", // Allows commits related to core functionality
                "forms", // Allows commits related to forms
                "http", // Allows commits related to HTTP requests or responses
                "language-service", // Allows commits related to language services
                "localization", // Allows commits related to localization
                "migration", // Allows commits related to migration tasks
                "packaging", // Allows commits related to packaging
                "router", // Allows commits related to routing
                "service-worker", // Allows commits related to service workers
                "upgrade", // Allows commits related to upgrades
                "user", // Allows commits related to user functionality
            ],
        ],
        // Enforces kebab-case for scopes to maintain consistency
        "scope-case": [2, "always", "kebab-case"],
        // Disallows specific cases for subjects to maintain readability
        "subject-case": [
            2, // Sets the rule to be an error if violated
            "never", // Ensures the rule is always applied
            ["sentence-case", "start-case", "pascal-case", "upper-case"], // Disallowed cases for subjects
        ],
        // Disallows full stops at the end of subjects to maintain clarity
        "subject-full-stop": [2, "never", "."],
    },
};
