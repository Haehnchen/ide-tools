<?php

namespace espend\Ide\Client;

interface IdeClientInterface
{

    const PROJECTS = '%s/project';
    const PROJECT_URL = '%s/project/%s';
    const PROJECT_CLEAR = '%s/project/clear';

    /**
     * Send all known data to ide server; clearing all previous data
     *
     * @param string $projectName ide/phpstorm project name
     * @param array $data mapped data with collector keys
     * @return \espend\Ide\Client\Response\IdeServerResponse
     */
    public function send($projectName, array $data);

    /**
     * Just update a single collector on server
     *
     * @param $projectName
     * @param $provider
     * @param array $data
     * @return \espend\Ide\Client\Response\IdeServerResponse
     */
    public function update($projectName, $provider, array $data);

    /**
     * Clear server storage on all collected data
     *
     * @param $projectName
     * @return \espend\Ide\Client\Response\IdeServerResponse
     */
    public function clear($projectName);

    /**
     * Show list of opened projects, which available to fill with data
     *
     * @return array currently opened projects
     */
    public function projects();
}