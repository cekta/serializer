# cekta/serializer

safe serialize/deserialize object to json.

reason for creation:

1. unserialize is not safe ([remote code execution](https://notsosecure.com/remote-code-execution-php-unserialize)).
2. json_decode cant return object with target type, only array or stdClass.
3. serialize data is not human-friendly.

## Features.

1. safe usage with any data.
2. deserialize to target object.
3. human-friendly data.