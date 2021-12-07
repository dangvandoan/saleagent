<?php
namespace AHT\SalesAgents\Api;

interface SalesagentRepositoryInterface
{
   /**
     * Undocumented function
     *
     * @param \AHT\SalesAgents\Api\Data\SalesagentInterface $salesagent
     * @return \AHT\SalesAgents\Api\Data\SalesagentInterface
     */
    public function save(\AHT\SalesAgents\Api\Data\SalesagentInterface $salesagent);
    

    /**
     * Undocumented function
     *
     * @param int $salesagentId
     * @return \AHT\SalesAgents\Api\Data\SalesagentInterface
     */
    public function getById($salesagentId);

    /**
     * Undocumented function
     *
     * @param \AHT\SalesAgents\Api\Data\SalesagentInterface $salesagents
     * @return \AHT\SalesAgents\Api\Data\SalesagentInterface
     */
    public function delete(\AHT\SalesAgents\Api\Data\SalesagentInterface $salesagent);
    
    /**
     * Undocumented function
     *
     * @param  int $salesagentsId
     * @return \AHT\SalesAgents\Api\Data\SalesagentInterface
     */
    public function deleteById($salesagentId);
}
